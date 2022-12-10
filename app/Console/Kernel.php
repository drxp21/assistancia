<?php

namespace App\Console;

use App\Mail\EnAttente;
use App\Mail\EnCours;
use App\Models\Demande;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isEmpty;

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
