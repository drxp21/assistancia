<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntrepriseStoreRequest;
use App\Http\Requests\EntrepriseUpdateRequest;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EntrepriseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $entreprises = Entreprise::all();

        // return Inertia::render('');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return Inertia::render('');
    }

    /**
     * @param \App\Http\Requests\EntrepriseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntrepriseStoreRequest $request)
    {
        $entreprise = Entreprise::create($request->validated());

        return redirect()->route('entreprise.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Entreprise $entreprise
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Entreprise $entreprise)
    {
        // return Inertia::render('');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Entreprise $entreprise
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Entreprise $entreprise)
    {
        // return Inertia::render('');
    }

    /**
     * @param \App\Http\Requests\EntrepriseUpdateRequest $request
     * @param \App\Models\Entreprise $entreprise
     * @return \Illuminate\Http\Response
     */
    public function update(EntrepriseUpdateRequest $request, Entreprise $entreprise)
    {
        $entreprise->update($request->validated());

        return redirect()->route('entreprise.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Entreprise $entreprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Entreprise $entreprise)
    {
        $entreprise->delete();

        return redirect()->route('entreprise.index');
    }
}
