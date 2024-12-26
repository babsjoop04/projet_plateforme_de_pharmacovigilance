<?php

namespace App\Http\Controllers;

use App\Models\Decision;
use Illuminate\Http\Request;
use App\Models\Traitement;

class DecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $decisions = $request->user()->decision()->get();
        $decisions = Decision::all();

        foreach ($decisions as $decision) {

            // $notification->aggregation()->create($produit_sante);
        }


        return $decisions;
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate(rules: [
            "traitement_id" => 'required',
            "decision" => 'required|in:suspension_AMM,retrait_AMM,rappel_lot,mise_en_quarantaine,restriction_utlisation_prescription,demande_modification_informations,changement_liste,reevaluation_rapport_benefice_risque',
        ]);

        $traitement = Traitement::find($request->traitement_id);
        
        $traitement->decision()->create($fields);

        return [
            'message' => 'Decision créé avec success',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Decision $decision)
    {
        //
        return $decision;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Decision $decision)
    {
        //
        $fields = $request->validate([
            "traitement_id" => 'required',
            "decision" => 'required|in:suspension_AMM,retrait_AMM,rappel_lot,mise_en_quarantaine,restriction_utlisation_prescription,demande_modification_informations,changement_liste,reevaluation_rapport_benefice_risque',
        ]);

        $decision->update($fields);

        return [
            'message' => 'Decision mise à jour avec success',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Decision $decision)
    {
        //
        $decision->delete();
        return [
            'message' => 'Decision supprimée avec success'
        ];
    }
}
