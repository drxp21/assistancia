<?php

<<<<<<< HEAD
use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Demande;
=======
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DemandeController;
<<<<<<< HEAD
use App\Mail\MailNouvelleDemande;
use App\Models\Demande;
use App\Models\User;
=======
use App\Mail\EnAttente;
use App\Mail\EnCours;
use App\Mail\Feedback;
use App\Models\Demande;
use App\Models\User;
use Carbon\Carbon;
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
use Illuminate\Foundation\Application;
>>>>>>> 55eecffa7e44b946ac5fa007165d181af020a851
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
<<<<<<< HEAD
=======

>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        switch (Auth::user()->role) {
            case 'client':
<<<<<<< HEAD
                $all_demandes=Demande::all();
                $mes_demandes=Demande::where('auteur_id',Auth::user()->id)->latest()->get();
                foreach ($mes_demandes as $demande ) {
                    $demande->auteur=User::find($demande->auteur_id)->name;
                }
                return Inertia::render('Client/Dashboard',['all_demandes'=>$all_demandes,'mes_demandes'=>$mes_demandes]);


=======
                return Inertia::render('Client/Dashboard');
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
                break;


            case 'admin':

<<<<<<< HEAD
                $all_demandes=Demande::where('admin_id',null)->latest()->get();
                foreach ($all_demandes as $demande ) {
                    $demande->auteur=User::find($demande->auteur_id)->name;
                }

                $mes_demandes=Demande::where('admin_id',Auth::user()->id)->latest()->get();
                foreach ($mes_demandes as $demande ) {
                    $demande->auteur=User::find($demande->auteur_id)->name;
                }

                return Inertia::render('Admin/Dashboard',['all_demandes'=>$all_demandes,'mes_demandes'=>$mes_demandes]);
=======
                $all_demandes = Demande::where('admin_id', null)->latest()->get();
                foreach ($all_demandes as $demande) {
                    $demande->auteur = User::find($demande->auteur_id)->name;
                }

                $mes_demandes = Demande::where('admin_id', Auth::user()->id)->latest()->get();
                foreach ($mes_demandes as $demande) {
                    $demande->auteur = User::find($demande->auteur_id)->name;
                }

                return Inertia::render('Admin/Dashboard', ['all_demandes' => $all_demandes, 'mes_demandes' => $mes_demandes]);
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195

                break;


            case 'super-admin':
                $users = User::where('role','admin')->get();
                foreach($users as $user)
                {
                    $user->demandeTraites = Demande::where([['admin_id',$user->id],['status','traite']])->get();
                }
                foreach($users as $user)
                {
                    $user->demandeRejetes = Demande::where([['admin_id',$user->id],['status','rejete']])->get();
                }

                return Inertia::render('SuperAdmin/Dashboard',['users'=>$users]);
                break;

            default:
                abort(404);
                break;
        }
    })->name('dashboard');


<<<<<<< HEAD
    //Route::resource('demandes',DemandeController::class);

    // en faisant ceci nous pourrons tous utiliser le meme controller
    Route::controller(DemandeController::class)->prefix('admin')->group(function () {
        Route::get('/demandes', 'admin_demandes')->name('admin.demandes');
        Route::get('/details/{id}','admin_details_show')->name('details');
        Route::post('/new','new_admin')->name('new.admin');
    });


<<<<<<< HEAD



});


=======

    Route::controller(DemandeController::class)->prefix('Client')->group(function () {
        Route::get('/FormDemande', 'create_demande')->name('create.demande');
        Route::post('/FormDemande', 'store_demande')->name('store.demande');

        Route::get('/DetailDemande/{id}', 'details_demandes')->name('details.demandes');
    });




});
// Route::get('/Form', function () {
//     return Inertia::render('Client/FormDemande');

// })->name('FormDemande');



=======
    // en faisant ceci nous pourrons tous utiliser le meme controller
    Route::controller(DemandeController::class)->prefix('admin')->group(function () {
        Route::get('/demandes', 'admin_demandes')->name('admin.demandes')->middleware('isAdmin');
        Route::get('/demande/{id}', 'admin_demande_show')->name('admin.demande')->middleware('isAdmin');
        Route::put('/handle_demande', 'admin_handle_demande')->name('admin.handle_demande')->middleware('isAdmin');
        Route::put('/feedback', 'admin_feedback')->name('admin.feedback')->middleware('isAdmin');
    });
});
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
>>>>>>> 55eecffa7e44b946ac5fa007165d181af020a851
