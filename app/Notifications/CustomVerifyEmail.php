<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    /**
     * Override method toMail untuk memodifikasi isi email.
     */
    public function toMail($notifiable)
    {
        // 1. Dapatkan URL verifikasi bawaan Laravel (sudah di-generate otomatis)
        $url = $this->verificationUrl($notifiable);

        // 2. Return MailMessage menggunakan data $notifiable secara langsung
        return (new MailMessage)
            ->subject('Verifikasi Email Akun CBT Anda')
            // Hapus $this-> dan langsung panggil $notifiable->name
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Terima kasih telah mendaftar di Aplikasi CBT ' . config('app.name') . '.')
            ->line('Klik tombol di bawah untuk memverifikasi alamat email Anda.')
            ->action('Verifikasi Email Sekarang', $url)
            ->line('Link verifikasi ini akan kedaluwarsa dalam 60 menit.')
            ->line('Jika Anda tidak membuat akun ini, abaikan email ini.');
    }
}