<?php

namespace App\Http\Controllers;

use App\Mail\Feedback;
use App\Mail\MailNouvelleDemande;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class DemandeController extends Controller
{

    public function admin_demandes()
    {
        $mes_demandes = Demande::where('admin_id', Auth::user()->id)->orderByRaw("FIELD(status, \"en_cours\", \"traite\", \"rejete\")")->get();
        foreach ($mes_demandes as $demande) {
            $demande->auteur = User::findOrFail($demande->auteur_id)->name;
        }
        return Inertia::render('Admin/MesDemandes', ['mes_demandes' => $mes_demandes]);
    }

    public function admin_demande_show(int $id)
    {
        $demande = Demande::findOrFail($id);
        $demande->auteur = User::findOrFail($demande->auteur_id);
        return Inertia::render('Admin/DetailDemande', ['demande' => $demande]);
    }


    public function admin_handle_demande(Request $request)
    {
        Demande::findOrFail($request->demande_id)
        ->update(
            [
                'status' => 'en_cours',
                'admin_id' => $request->admin_id
            ]);
    }



    public function admin_feedback(Request $request)
    {
        request()->validate([
            'feedback' => 'required'
        ]);
        Demande::findOrFail($request->demande_id)
            ->update(
                [
                    'status' => ($request->type == 'feedback') ? 'traite' : 'rejete',
                    'feedback' => $request->feedback,
                ]
            );
        $type = $request->type == 'feedback' ? 'traitée' : 'rejetée';
        Mail::to($request->demande_auteur['email'])->send(new Feedback($type, $request->feedback));
    }






    public function client_details_demandes($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->auteur = User::findOrFail($demande->auteur_id);

        return Inertia::render('Client/DetailDemande', ['demande' => $demande]);
    }

    public function client_show_demandes()
    {
        $all_demandes = Demande::all();
                $mes_demandes = Demande::where('auteur_id', Auth::user()->id)->latest()->get();
                foreach ($mes_demandes as $demande) {
                    $demande->auteur = User::find($demande->auteur_id)->name;
                }
                return Inertia::render('Client/Mesdemandes', ['all_demandes' => $all_demandes, 'mes_demandes' => $mes_demandes]);
    }



    public function client_create_demande()
    {
        return Inertia::render(
            'Client/FormDemande'
        );
    }

    public function client_store_demande(Request $request)
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
        $admins = User::where('role', 'admin')->latest()->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new MailNouvelleDemande($admin->name, $request->objet,$request->contenu));
        }
        return redirect()->route('show.demande');
    }
}
