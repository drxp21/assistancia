<?php

use App\Http\Controllers\AdminController;
use App\Models\Demande;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

    // Demande::create([
    //     "status"=>"en_attente",
    //     "contenu"=>"EKIP ekip Ekip",
    //     "auteur_id"=>"1",
    //     "admin_id"=>"2",

    // ]);
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
                return Inertia::render('Client/Dashboard');
                break;
            case 'admin':
                return Inertia::render('Admin/Dashboard');

                break;
            case 'super-admin':
                return Inertia::render('SuperAdmin/Dashboard');
                break;

            default:
                abort(404);
                break;
        }
    })->name('dashboard');


    Route::resource('demande', App\Http\Controllers\DemandeController::class);

    Route::resource('user', App\Http\Controllers\UserController::class);

    Route::resource('entreprise', App\Http\Controllers\EntrepriseController::class);
});



