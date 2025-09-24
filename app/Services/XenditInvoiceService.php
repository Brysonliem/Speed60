<?php
// app/Services/XenditInvoiceService.php

namespace App\Services;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\XenditSdkException;

class XenditInvoiceService
{
    private \Xendit\Invoice\InvoiceApi $api;
    private ?string $forUserId;

    public function __construct()
    {
        // Inisialisasi konfigurasi SDK
        $config = Configuration::getDefaultConfiguration()
            ->setApiKey(config('xendit.secret_key', env('XENDIT_SECRET_KEY')));

        $this->api = new InvoiceApi(null, $config);
        // $this->forUserId = config('xendit.for_user_id', env('XENDIT_SUB_ACCOUNT_ID')); // opsional
    }

    /**
     * Buat invoice Xendit dan kembalikan array hasilnya.
     * @param array $params [
     *   external_id, amount(int), description, payer_email?, currency?, success_redirect_url?, failure_redirect_url?,
     *   invoice_duration?, reminder_time?
     * ]
     */
    public function create(array $params): array
    {
        $request = new CreateInvoiceRequest([
            'external_id'          => $params['external_id'],
            'amount'               => (int) $params['amount'],
            'description'          => $params['description'] ?? null,
            'payer_email'          => $params['payer_email'] ?? null,
            'currency'             => $params['currency'] ?? config('xendit.currency', env('XENDIT_CURRENCY', 'IDR')),
            'success_redirect_url' => $params['success_redirect_url'] ?? null,
            'failure_redirect_url' => $params['failure_redirect_url'] ?? null,
            // opsional:
            'invoice_duration'     => $params['invoice_duration'] ?? null,
            'reminder_time'        => $params['reminder_time'] ?? null,
        ]);

        try {
            // Jika pakai sub-account, teruskan $for_user_id; kalau tidak, biarkan null
            $result = $this->api->createInvoice(
                $request,
                null // for_user_id (opsional)
            );

            // $result adalah model; kembalikan sebagai array sederhana
            return [
                'id'          => $result->getId(),
                'status'      => $result->getStatus(),
                'invoice_url' => $result->getInvoiceUrl(),
                'external_id' => $result->getExternalId(),
            ];
        } catch (XenditSdkException $e) {
            // Lempar lagi sebagai exception Laravel dengan konteks
            throw new \RuntimeException(
                sprintf(
                    'Xendit error: %s | detail: %s',
                    $e->getMessage(),
                    json_encode($e->getFullError(), JSON_UNESCAPED_SLASHES)
                ),
                previous: $e
            );
        }
    }
}
