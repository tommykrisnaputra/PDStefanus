<?php

namespace App\Console;

use App\Notifications\BirthdayDaily;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DateTimeZone;

class Kernel extends ConsoleKernel
{
    /**
     * Get the timezone that should be used by default for scheduled events.
     */
    protected function scheduleTimezone(): DateTimeZone|string|null
    {
        return 'Asia/Jakarta';
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // php artisan schedule:work
        $schedule->call(function () {
            $email = 'stefan_news@yahoo.com';
            Notification::route('mail', $email)->notify(new BirthdayDaily());
        })
            ->dailyAt('10:00')
            // ->everyMinute()
            ->environments(['production']);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}