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
        ->dailyAt('23:30');
        $schedule->call('App\Http\Controllers\ExportController@autotal')
         ->dailyAt('19:30');
        $schedule->call('App\Http\Controllers\ScheduleController@tlccheck')
        ->dailyAt('09:05');
        $schedule->call('App\Http\Controllers\ScheduleController@tlcchecknow')
        ->dailyAt('09:10');
        $schedule->call('App\Http\Controllers\ScheduleController@servercatch')
        ->twiceDaily(07,12);
        $schedule->call('App\Http\Controllers\ScheduleController@contractcheck')
        ->dailyAt('09:20');
        $schedule->call('App\Http\Controllers\ScheduleController@licensecheck')
        ->dailyAt('09:30');
        $schedule->call('App\Http\Controllers\ScheduleController@licenseend')
        ->dailyAt('08:30');                    
        //$schedule->call('App\Http\Controllers\LetterController@letter')
        //->weekly()->fridays()->at('09:30');
        
        

        
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
