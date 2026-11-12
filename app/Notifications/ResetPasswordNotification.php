<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(public string $token)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = url('/reset-password/' . $this->token) . '?email=' . urlencode($notifiable->getEmailForPasswordReset());

        return (new MailMessage)
            ->subject('Reset Password - ' . config('app.name'))
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Kami menerima permintaan untuk mengatur ulang password akun Anda.')
            ->line('Klik tombol di bawah ini untuk membuat password baru. Link ini kedaluwarsa dalam 60 menit.')
            ->action('Ganti Password Sekarang', $url)
            ->line('Jika Anda tidak meminta reset password, abaikan email ini — password Anda tetap aman.')
            ->salutation('Salam, ' . config('app.name'));
    }
}
