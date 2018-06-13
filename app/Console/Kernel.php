<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Http\Request;
use File;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

    \App\Console\Commands\TestMail::class,
    \App\Console\Commands\TestEventCommand::class,
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
         //$schedule->command('test:Log')->twiceDaily(13, 20);
         
        //$schedule->call('App\Http\Controllers\EmailController@index')
        //->dailyAt('08:30');    
         //->twiceDaily(13, 20);
         //->everyMinute();
        //$schedule->call('App\Http\Controllers\ScheduleController@getuser')
        //->dailyAt('08:30');
        
        $schedule->call('App\Http\Controllers\ScheduleController@matchtime')
        ->dailyAt('08:30');
        //$schedule->call('App\Http\Controllers\VerController@dailycatch')
        //->dailyAt('09:30');
        //
        $schedule->call('App\Http\Controllers\ScheduleController@tlcalert')
        ->dailyAt('09:00');
        $schedule->call('App\Http\Controllers\ScheduleController@servercatch')
        ->twiceDaily(07,12);
        $schedule->call('App\Http\Controllers\ScheduleController@contractalert')
        ->dailyAt('09:00');
        $schedule->call('App\Http\Controllers\ScheduleController@licensealert')
        ->dailyAt('09:00');
         $schedule->call('App\Http\Controllers\ScheduleController@licenseend')
        ->dailyAt('08:00');
        
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {

        require base_path('routes/console.php');
    }
}
