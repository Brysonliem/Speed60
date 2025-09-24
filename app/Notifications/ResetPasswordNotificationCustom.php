<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotificationCustom extends Notification implements ShouldQueue
{
    use Queueable;
    public function __construct(public string $resetUrl) {}

    public function via($notifiable) { return ['mail']; }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reset Password Akun Anda')
            ->greeting('Halo, '.$notifiable->name)
            ->line('Kami menerima permintaan reset password untuk akun Anda.')
            ->action('Setel Ulang Password', $this->resetUrl)
            ->line('Link ini akan kadaluarsa dalam 60 menit.')
            ->line('Jika Anda tidak meminta reset, abaikan email ini.');
    }
}
