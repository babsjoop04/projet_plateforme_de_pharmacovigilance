<?php

namespace App\Http\Controllers;

use App\Models\Traitement;
use App\Http\Requests\StoreTraitementRequest;
use App\Http\Requests\UpdateTraitementRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TraitementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate::authorize("view_any_notification", $request->user());
        
        return Traitement::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gate::authorize("create_traitement", $request->user());
        $traitement=Traitement::where('notification_id',$request->notification_id)->first();
        if($traitement){
            return [
                "message"=>"La notification est deja en cours de traitement"
            ];

        }


        $fields=$request->validate([
            // "user_id"=> 'required',
            "notification_id"=> 'required',
            "necessite_imputabilite"=> 'required',
            // "resultat_imputabilite"=> 'nullable',
            "statut_traitement"=> 'required',
            // "decision"=> 'nullable'

        ]);

        $traitement=$request->user()->traitement()->create($fields);

        return $traitement;




    }

    /**
     * Display the specified resource.
     */
    public function show(Traitement $traitement)
    {
        // Gate::authorize("view_any_notification", $request->user());
        return $traitement;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Traitement $traitement)
    {
        // Gate::authorize("view_any_notification", $request->user());
        $fields=$request->validate([
            // "user_id"=> 'required',
            "notification_id"=> 'required|unique',
            "necessite_imputabilite"=> 'required',
            // "resultat_imputabilite"=> 'nullable',
            "statut_traitement"=> 'required',
            // "decision"=> 'nullable'

        ]);

        $traitement->update($fields);

        return $traitement;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Traitement $traitement)
    {
        // Gate::authorize("delete_traitement");
        $traitement->delete();
    }
}
