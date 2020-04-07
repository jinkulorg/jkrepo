<?php

namespace App\Console;

use App\Http\Controllers\ProfilesController;
use App\Profile;
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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            $totalFemaleProfiles = Profile::where('STATUS','!=','INACTIVE')->where('gender','=','F')->get()->count() - 1;
            
            $allProfiles = Profile::all();
            foreach($allProfiles as $profile) {
                $activePayments = $profile->Payment->where('START_DATE','<=',date('Y-m-d'))->where('END_DATE','>=',date('Y-m-d'))->where('SOURCE','=','P')->where('STATUS','=','TXN_SUCCESS');
                $inActivePayments = $profile->Payment->where('SOURCE','=','P')->where('STATUS','=','TXN_SUCCESS');

                if (sizeof($activePayments) == 0 && sizeof($inActivePayments) != 0) {
                    if(OFFER_FREE == "FREE" && $profile->gender == 'F' && $totalFemaleProfiles < MAX_FREE_PROFILE_FOR_GIRLS) {
                        $profileController = new ProfilesController();
                        $profileController->activateProfileForFree($profile->id);
                    } else {
                        $profile->status = "RENEW";
                        $profile->save();
                    }

                    $activePromotedPayments = $profile->Payment->where('START_DATE','<=',date('Y-m-d'))->where('END_DATE','>=',date('Y-m-d'))->where('SOURCE','=','FP')->where('STATUS','=','TXN_SUCCESS');

                    foreach($activePromotedPayments as $activePromotedPayment) {
                        $activePromotedPayment->END_DATE = date('Y/m/d', strtotime("-1 days", strtotime(date("Y/m/d"))));
                        $activePromotedPayment->save();
                    }

                    $promotedProfiles = $profile->featuredprofile->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'));

                    foreach($promotedProfiles as $promotedProfile) {
                        $promotedProfile->end_date = date('Y/m/d', strtotime("-1 days", strtotime(date("Y/m/d"))));
                        $promotedProfile->save();
                    }
                }
            }
            
        })->daily();
        // })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
