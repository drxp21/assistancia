<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeStoreRequest;
use App\Http\Requests\DemandeUpdateRequest;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
