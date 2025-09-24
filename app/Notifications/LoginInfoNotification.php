<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginInfoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $ip,
        public string $agent,
        public string $when
    ) {}

    public function via($notifiable) { return ['mail']; }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Informasi Login Berhasil')
            ->markdown('emails.auth.login-info', [
                'user' => $notifiable,
                'ip'   => $this->ip,
                'agent'=> $this->agent,
                'when' => $this->when,
            ]);
    }
}
