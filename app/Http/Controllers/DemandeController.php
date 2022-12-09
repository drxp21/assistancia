<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeStoreRequest;
use App\Http\Requests\DemandeUpdateRequest;
use App\Mail\MailNouvelleDemande;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class DemandeController extends Controller
{
    public function store_demande(Request $request)
    {
        $request->validate([
            'objet' => 'required',
            'contenu' => 'required',
            // 'auteur_id' => 'required',
            // 'status' => 'required'
        ]);
        Demande::create([
            'objet' => $request->objet,
            'contenu' => $request->contenu,
            'auteur_id' => Auth::user()->id

        ]);
        $admins=User::where('role', 'admin')->latest()->get();
        foreach($admins as $admin){
        Mail::to($admin->email)->send(new MailNouvelleDemande($admin->name,$request->objet));
        }
        return redirect()->route('dashboard');

    }




    public function admin_demandes()
    {
        $mes_demandes = Demande::where('admin_id', Auth::user()->id)->latest()->get();
        foreach ($mes_demandes as $demande) {
            $demande->auteur = User::find($demande->auteur_id)->name;
        }

        return Inertia::render('Admin/MesDemandes', ['mes_demandes' => $mes_demandes]);
    }



    public function details_demandes($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->auteur= User::findOrFail($demande->auteur_id);
        // $mes_demandes = Demande::where('auteur_id', Auth::user()->id)->latest()->get();
        // $dem_id=Demande::where('id',$id)->latest()->get();



        return Inertia::render('Client/DetailDemande', ['demande' => $demande]);
    }



    public function create_demande()
    {
        return Inertia::render(
            'Client/FormDemande'
        );
    }

}
