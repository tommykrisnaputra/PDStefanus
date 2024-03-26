<?php

namespace App\Console;

use App\Models\User;
use App\Notifications\BirthdayDailyDatabase;
use App\Notifications\BirthdayDailyMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DateTimeZone;

class Kernel extends ConsoleKernel {
    /**
     * Get the timezone that should be used by default for scheduled events.
     */
    protected function scheduleTimezone(): DateTimeZone|string|null {
        return 'Asia/Jakarta';
        }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void {
        $schedule->call(function () {
            $today = now();

            $user = User::whereMonth('birthdate', $today->month)
                ->whereDay('birthdate', $today->day)
                ->get();

            if ($user->isNotEmpty()) {
                $admin      = User::where('role_id', 2)->get();
                $pdstefanus = User::find(1);

                Notification::send($admin, new BirthdayDailyDatabase($user));
                Notification::send($pdstefanus, new BirthdayDailyMail($user));
                }
            })->dailyAt('02:00');

        Log::info('schedule run');
        }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
        }
    }