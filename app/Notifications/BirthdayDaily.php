<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BirthdayDaily extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $today = now();

        $user = User::whereMonth('birthdate', $today->month)
            ->whereDay('birthdate', $today->day)
            ->get();

        $mail = (new MailMessage)
            ->subject('PD Stefanus - Umat Berulang Tahun')
            ->greeting('Hai!')
            ->line('Berikut adalah list umat yang berulang tahun pada hari ini ' . date('d M Y', strtotime($today)));

        foreach($user as $line) {
            $mail->line('Nama: ' . $line->full_name . ', Whatsapp: ' . $line->phone);
        }

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}