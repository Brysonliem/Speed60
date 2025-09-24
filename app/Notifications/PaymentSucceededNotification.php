<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSucceededNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public bool $afterCommit = true; // kirim hanya setelah DB commit

    public function __construct(
        public string $orderCode,
        public int|float $amount,
        public ?string $paymentMethod = null
    ) {}

    public function via($notifiable) { return ['mail']; }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pembayaran Berhasil • '.$this->orderCode)
            ->markdown('emails.orders.paid', [
                'user'   => $notifiable,
                'code'   => $this->orderCode,
                'amount' => $this->amount,
                'method' => $this->paymentMethod,
            ]);
    }
}
