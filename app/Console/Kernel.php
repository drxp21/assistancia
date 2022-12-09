<?php

namespace App\Console;

<<<<<<< HEAD
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
=======
use App\Mail\EnAttente;
use App\Mail\EnCours;
use App\Models\Demande;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isEmpty;
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
<<<<<<< HEAD
        // $schedule->command('inspire')->hourly();
=======
        $schedule->call(function () {
            $admins = User::where('role', 'admin')->get();
            $demandes = Demande::where('admin_id', null)
                ->whereDate('created_at', Carbon::now()->subDays(2))
                ->orWhereDate('created_at', Carbon::now()->subDays(4))
                ->orWhereDate('created_at', Carbon::now()->subDays(7))
                ->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new EnAttente($admin->name, $demandes));
            }
        })->daily();

        $schedule->call(function () {
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $demandes=Demande::where('admin_id',$admin->id)->where('status','en_cours')->get();
                if(!empty($demandes)){
                    Mail::to($admin->email)->send(new EnCours($admin->name,$demandes));
                }
            }
        })->daily();
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
<<<<<<< HEAD
        $this->load(__DIR__.'/Commands');
=======
        $this->load(__DIR__ . '/Commands');
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195

        require base_path('routes/console.php');
    }
}
