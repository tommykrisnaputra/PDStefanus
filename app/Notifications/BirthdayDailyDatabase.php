<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BirthdayDailyDatabase extends Notification {
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($user) {
        $this->user = $user;
        }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array {
        return ['database'];
        // return ['mail', 'database'];
        }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage {
        $add   = [];
        $today = now();

        $mail = (new MailMessage)
            ->subject('PD Stefanus - Umat Berulang Tahun')
            ->greeting('Hai!')
            ->line('Berikut adalah list umat yang berulang tahun pada hari ini ' . date('d M Y', strtotime($today)));

        foreach ($this->user as $line) {
            $add[] = $line->full_name;
            }

        $mail->line('Nama: ' . implode(", ", $add));

        return $mail;
        }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable) {
        $add = [];

        foreach ($this->user as $line) {
            $add[] = $line->full_name;
            }

        return $add;
        }
    }