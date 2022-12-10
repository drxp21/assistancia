<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();

        return Inertia::render('User/Index',['users'=>$users]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('User/Create');
    }

    /**
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make('password')
        ]);


    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\user $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user=User::find($request->id);
        return Inertia::render('User/Show',['user'=>$user]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\user $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user=User::find($request->id);
        return Inertia::render('User/Edit',['user'=>$user]);
    }

    /**
     * @param \App\Http\Requests\Request $request
     * @param \App\user $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate();
        $user=User::find($request->id);
        return Inertia::render('User/Edit',['user'=>$user]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\user $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        User::where('id',$request->id)->delete();
        return Inertia::render('User/Index');
    }
}
