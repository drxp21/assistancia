<?php

use Inertia\Inertia;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
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
                $all_demandes = Demande::all();
                $mes_demandes = Demande::where('auteur_id', Auth::user()->id)->latest()->get();
                foreach ($mes_demandes as $demande) {
                    $demande->auteur = User::find($demande->auteur_id)->name;
                }
                return Inertia::render('Client/Dashboard', ['all_demandes' => $all_demandes, 'mes_demandes' => $mes_demandes]);


                break;


            case 'admin':

                $all_demandes = Demande::where('admin_id', null)->latest()->get();
                foreach ($all_demandes as $demande) {
                    $demande->auteur = User::find($demande->auteur_id)->name;
                }

                $mes_demandes = Demande::where('admin_id', Auth::user()->id)->latest()->get();
                foreach ($mes_demandes as $demande) {
                    $demande->auteur = User::find($demande->auteur_id)->name;
                }

                return Inertia::render('Admin/Dashboard', ['all_demandes' => $all_demandes, 'mes_demandes' => $mes_demandes]);

                break;


            case 'super-admin':
                $users = User::where('role', 'admin')->get();
                foreach ($users as $user) {
                    $user->demandeTraites = Demande::where([['admin_id', $user->id], ['status', 'traite']])->get();
                }
                foreach ($users as $user) {
                    $user->demandeRejetes = Demande::where([['admin_id', $user->id], ['status', 'rejete']])->get();
                }

                return Inertia::render('SuperAdmin/Dashboard', ['users' => $users]);
                break;

            default:
                abort(404);
                break;
        }
    })->name('dashboard');


    Route::controller(DemandeController::class)->prefix('admin')->middleware('isAdmin')->group(function () {
        Route::get('/demandes', 'admin_demandes')->name('admin.demandes');
        Route::get('/demande/{id}', 'admin_demande_show')->name('admin.demande');
        Route::put('/handledemande', 'admin_handle_demande')->name('admin.handle_demande');
        Route::put('/feedbackdemande', 'admin_feedback')->name('admin.feedback');
    });

    Route::controller(UserController::class)->prefix('superadmin')->middleware('isSuperAdmin')->group(function () {
        Route::post('/new', 'superadmin_new_admin')->name('new.admin');
        Route::get('/details/{id}', 'superadmin_admin_details_show')->name('superadmin.user');
    });

    Route::controller(DemandeController::class)->prefix('Client')->middleware('isClient')->group(function () {
        Route::get('/FormDemande', 'client_create_demande')->name('create.demande');
        Route::post('/FormDemande', 'client_store_demande')->name('store.demande');
        Route::get('/DetailDemande/{id}', 'client_details_demandes')->name('details.demandes');
    });
});
