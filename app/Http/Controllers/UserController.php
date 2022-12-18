<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function superadmin_new_admin(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
       User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make('password'),
            'role'=>'admin'
       ]);
    }

    public function superadmin_admin_details_show(int $id)
    {
        $user = User::findOrFail($id);

        return Inertia::render('SuperAdmin/Details', ['user' => $user]);
    }
    public function superadmin_admin()
    {
        $users = User::where('role', 'admin')->get();
        $users->demandes = Demande::where('admin_id', Auth::user()->id)->get();
        return Inertia::render('SuperAdmin/Dashboard', ['users' => $users]);
    }




}
