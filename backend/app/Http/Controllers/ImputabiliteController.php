<?php

namespace App\Http\Controllers;

use App\Models\Imputabilite;
use App\Models\Traitement;
use Illuminate\Http\Request;

class ImputabiliteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Imputabilite::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields=$request->validate([
            "traitement_id"=> 'required',
            "classification"=> 'required|in:Certain,Probable,Possible,Improbable,"Conditionnelle / Non classée","Non évaluable / Non classée",Non lié,Lien indéterminé',
        ]);

        $traitement=Traitement::find($request->traitement_id);
        $traitement->imputabilite()->create($fields);

        return [
            'message'=> 'Imputabilite créé avec success',
        ];



    }

    /**
     * Display the specified resource.
     */
    public function show(Imputabilite $imputabilite)
    {
        //
        return $imputabilite;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imputabilite $imputabilite)
    {
        //
        $fields=$request->validate([
            "traitement_id"=> 'required',
            "classification"=> 'required|in:Certain,Probable,Possible,Improbable,"Conditionnelle / Non classée","Non évaluable / Non classée",Non lié,Lien indéterminé',
        ]);

        $imputabilite->update($fields);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imputabilite $imputabilite)
    {
        //
        $imputabilite->delete();

    }
}
