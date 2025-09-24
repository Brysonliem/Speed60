<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class XenditWebhookController extends Controller
{
    public function invoice(Request $request)
    {
        // 1) Validasi callback token (set juga di .env & config/xendit.php)
        $token = $request->header('x-callback-token');
        if ($token !== config('xendit.callback_token')) {
            Log::warning('Xendit webhook invalid token', ['got' => $token]);
            return response('Forbidden', Response::HTTP_FORBIDDEN);
        }

        // 2) Ambil payload
        $payload = $request->all();
        Log::info('Xendit webhook (invoice) received', $payload);

        $invoiceId  = data_get($payload, 'id');           // "inv-..."
        $externalId = data_get($payload, 'external_id');  // "order-....."
        $status     = strtoupper((string) data_get($payload, 'status')); // PAID|PENDING|EXPIRED|FAILED

        if (!$invoiceId && !$externalId) {
            return response('Bad Request: no invoice id', Response::HTTP_BAD_REQUEST);
        }

        // 3) Proses di dalam transaksi DB + kunci baris (hindari race)
        return DB::transaction(function () use ($invoiceId, $externalId, $status) {

            // Temukan order berdasarkan xendit_invoice_id ATAU external_id (kalau kamu simpan)
            /** @var Order|null $order */
            $order = Order::when($externalId, fn($q) => $q->where(column: 'external_id', operator: $externalId))
                          ->lockForUpdate()
                          ->first();

            if (!$order) {
                return response('Order not found', Response::HTTP_NOT_FOUND);
            }

            // Idempotency: jika sudah completed, jangan proses ulang
            if ($order->status === 'COMPLETED') {
                return response('OK (already completed)', Response::HTTP_OK);
            }

            // Mapping status Xendit → status Order
            if ($status === 'PAID') {
                // contoh: selesaikan transaksi dan stok...
                $transaction = Transaction::with('details')->where('id',$order->transaction_id)->first();

                foreach ($transaction->details as $d) {
                    $variant = app(ProductService::class)->getVariantById($d->detail_variant);
                    if ($variant) {
                        $variant->current_stock -= ($variant->purchase_unit === 'set')
                            ? $d->detail_qty * $variant->unit_per_set
                            : $d->detail_qty;
                        $variant->save();
                    }
                }

                // (pindahkan update transaksi di luar loop supaya sekali update)
                $transaction->update(['transaction_status' => 'completed']);

                // Update order -> COMPLETED
                $order->update(['status' => 'COMPLETED']);

                // === Kirim email sekali saja (idempotent) ===
                if (is_null($order->paid_notified_at)) {
                    // set flag dulu di dalam transaksi
                    $order->update(['paid_notified_at' => now()]);

                    // ambil data untuk email
                    $amount = $transaction->amount ?? ($order->total_amount ?? 0);
                    $code   = $order->code ?? $order->id;
                    $method = $transaction->payment_method ?? null;

                    // kirim ke pemilik order (pastikan relasi ada)
                    $user = Auth::user(); 
                    if ($user) {
                        $user->notify(new \App\Notifications\PaymentSucceededNotification($code, $amount, $method));
                    } else if (!empty($order->email)) {
                        // fallback kalau order hanya simpan email, bukan relasi user
                        \Illuminate\Support\Facades\Notification::route('mail', $order->email)
                            ->notify(new \App\Notifications\PaymentSucceededNotification($code, $amount, $method));
                    }

                    // (opsional) kirim ke admin/finance
                    // \Illuminate\Support\Facades\Notification::route('mail', 'finance@yourdomain.com')
                    //     ->notify(new \App\Notifications\PaymentSucceededNotification($code, $amount, $method));
                }

                return response('OK', 200);
            } elseif ($status === 'EXPIRED') {
                $order->update(['status' => 'EXPIRED']);
                // kalau kamu punya mekanisme reserved_stock, bisa dikembalikan di sini
            } elseif ($status === 'FAILED') {
                $order->update(['status' => 'FAILED']);
            } else {
                // PENDING / lainnya — cukup catat
                $order->update(['status' => 'PENDING']);
            }

            return response('OK', Response::HTTP_OK);
        });
    }
}
