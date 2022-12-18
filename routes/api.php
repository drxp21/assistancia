<?php

use App\Models\Demande;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/stats/{id}/{period}', function ($id, $period) {
    $monthly_period = [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
    $weekly_period = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
    switch ($period) {
        case 'all':
            return [
                Demande::where('admin_id', $id)->where('status', 'traite')->count(),
                Demande::where('admin_id', $id)->where('status', 'en_cours')->count(),
                Demande::where('admin_id', $id)->where('status', 'rejete')->count()
            ];
            break;

        case 'monthly':
            return [
                Demande::where('admin_id', $id)
                    ->where('status', 'traite')
                    ->whereBetween('updated_at', $monthly_period)
                    ->count(),
                Demande::where('admin_id', $id)
                    ->where('status', 'en_cours')
                    ->whereBetween('updated_at', $monthly_period)
                    ->count(),
                Demande::where('admin_id', $id)
                    ->where('status', 'rejete')
                    ->whereBetween('updated_at', $monthly_period)
                    ->count()
            ];
            break;

        case 'weekly':
            return [
                Demande::where('admin_id', $id)
                    ->where('status', 'traite')
                    ->whereBetween('updated_at', $weekly_period)
                    ->count(),
                Demande::where('admin_id', $id)
                    ->where('status', 'en_cours')
                    ->whereBetween('updated_at', $weekly_period)
                    ->count(),
                Demande::where('admin_id', $id)
                    ->where('status', 'rejete')
                    ->whereBetween('updated_at', $weekly_period)
                    ->count()
            ];
            break;

        case 'daily':
            return [Demande::where('admin_id', $id)->where('status', 'traite')->whereBetween('updated_at', [Carbon::today(), Carbon::now()])->count(), Demande::where('admin_id', $id)->where('status', 'en_cours')->whereBetween('updated_at', [Carbon::today(), Carbon::now()])->count(), Demande::where('admin_id', $id)->where('status', 'rejete')->whereBetween('updated_at', [Carbon::today(), Carbon::now()])->count()];

            break;

        default:
            abort(404);
            break;
    }
})->name('stats');

Route::get('/all', function () {
    return [
        Demande::where('status', 'traite')->count(),
        Demande::where('status', 'en_cours')->count(),
        Demande::where('status', 'rejete')->count()
    ];
})->name('all');

Route::get('/one/{id}', function ($id) {
    return [
        Demande::where('admin_id', $id)
            ->where('status', 'traite')->count(),
        Demande::where('admin_id', $id)
            ->where('status', 'en_cours')->count(),
        Demande::where('admin_id', $id)
            ->where('status', 'rejete')->count()
    ];
})->name('one');
