<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeStoreRequest;
use App\Http\Requests\DemandeUpdateRequest;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DemandeController extends Controller
{

    public function admin_demandes(){
        $mes_demandes=Demande::where('admin_id',Auth::user()->id)->latest()->get();
        foreach ($mes_demandes as $demande ) {
            $demande->auteur=User::find($demande->auteur_id)->name;
        }
        return Inertia::render('Admin/MesDemandes',['mes_demandes'=>$mes_demandes]);
    }
}
