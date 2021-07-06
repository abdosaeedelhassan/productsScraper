<?php

namespace App\Console;

use App\Scrapers\AmazonScraper;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {

            $settings = getSetting([
                'search_keywords',
                'search_hours',
                'search_minutes',
                'last_search_time'
            ], null);

            $search_keywords = $settings['search_keywords'];
            $search_hours = $settings['search_hours'];
            $search_minutes = $settings['search_minutes'];
            $last_search_time = $settings['last_search_time'];

            if ($search_keywords && $search_hours && $search_minutes) {
                $totalTimeInMinutes = ($search_hours * 60) + $search_minutes;
                $now = new \DateTime();
                if ($last_search_time) {
                    $future_date = new \DateTime($last_search_time);
                } else {
                    $last_search_time = date('Y-m-d H:i:s');
                    $future_date = new \DateTime($last_search_time);
                }
                $future_date->modify('+' . $totalTimeInMinutes . ' minutes');
                $formatted_date = $future_date->format('Y-m-d H:i:s');
                if ($now->format('Y-m-d H:i:s') > $formatted_date) {
                    AmazonScraper::getSearch($search_keywords);
                    saveSetting('last_search_time', date('Y-m-d H:i:s'));
                }
            }

        })->everyMinute()->timezone(config('app.timezone'));

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
