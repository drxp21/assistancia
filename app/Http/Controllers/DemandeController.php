<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeStoreRequest;
use App\Http\Requests\DemandeUpdateRequest;
use App\Models\Demande;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DemandeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $demandes = Demande::all();
        return Inertia::render('Demande/Index',['demandes'=>$demandes]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Demande/Create');
    }

    /**
     * @param \App\Http\Requests\DemandeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate();

        Demande::created($request->all());

        return Inertia::render('Demande/Index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Demande $demande
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $demande=Demande::find($request->id);
        return Inertia::render('Demande/Show',['demande'=>$demande]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Demande $demande
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $demande=Demande::find($request->id);
        return Inertia::render('Demande/Edit',['demande'=>$demande]);
    }

    /**
     * @param \App\Http\Requests\DemandeUpdateRequest $request
     * @param \App\Models\Demande $demande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate();

        Demande::where('id',$request->id)->update($request->all);

        return Inertia::render('Demande/Index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Demande $demande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Demande $demande)
    {
        Demande::where('id',$request->id)->delete();
        return Inertia::render('Demande/Index');
    }
}
