<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeStoreRequest;
use App\Http\Requests\DemandeUpdateRequest;
use App\Mail\Feedback;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        Demande::findOrFail($request->demande_id)->update(['status' => 'en_cours', 'admin_id' => $request->admin_id]);
    }



    public function admin_feedback(Request $request)
    {
        request()->validate([
            'feedback' => 'required'
        ]);
        Demande::findOrFail($request->demande_auteur['id'])->update([
            'feedback' => $request->feedback,
            'status' => $request->type == 'feedback' ? 'traite' : 'rejete',
        ]);
        $type = $request->type == 'feedback' ? 'traitée' : 'rejetée';
        Mail::to($request->demande_auteur['email'])->send(new Feedback($type,$request->feedback));
    }
    public function superAdmin_admin(){
        $users = User::where('role','admin')->get();
        $users->demandes = Demande::where('admin_id',Auth::user()->id)->get();
        return Inertia::render('SuperAdmin/Dashboard',['users'=>$users]);
    }
    public function admin_details_show(int $id){
        $user = User::findOrFail($id);

        return Inertia::render('SuperAdmin/Details',['user'=>$user]);
    }
    public function new_admin(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'profile_photo_path'=>'image|max:1024'
        ]);
        // Créer le programme en excluant la photo
        $user = new User($request->except('photo'));
        $user->password = Hash::make('password');
        $user->role = 'admin';
        // verifier si la photo est bien passée en paramètre
        if($request->file('photo')) {
            // recuperation de l'extension de la photo
            $extension = $request->file('photo')->getClientOriginalExtension();
            // stockage et recuperation du lien de la photo
            $path = $request->file('photo')->storeAs('public/profile-photos',uniqid().'.'.$extension);
            // assignation du chemin à l'objet photo
            $user->profile_photo_path = $path;
        }
        $user->save();
    }


}
