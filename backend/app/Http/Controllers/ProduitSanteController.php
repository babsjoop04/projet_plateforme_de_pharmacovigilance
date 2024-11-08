<?php

namespace App\Http\Controllers;

use App\Models\Produit_sante;
use Illuminate\Http\Request;

class ProduitSanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Produit_sante::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([
            // 'nom_produit' => 'required',
            // 'type_produit' => 'required|in:medicament,vaccin,autre',
            // 'numero_AMM' => 'required',
            // 'DCI' => 'required',
            // 'dosage' => 'required',
            // 'conditionnement' => 'required',
            // 'forme_galénique' => 'required',
            // 'laboratoire' => 'required',
            // 'voie_administration' => 'required',
            // 'classe_thérapeutique' => 'required',
            

        ]);
         Produit_sante::create($fields);

         return [
            "message"=> 'Produit ajouté avec success',

         ];

    }

    /**
     * Display the specified resource.
     */
    public function show(Produit_sante $produit_sante)
    {
        //
        return $produit_sante;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit_sante $produit_sante)
    {
        //
        $fields = $request->validate([
            // 'nom_produit' => 'required',
            // 'type_produit' => 'required|in:medicament,vaccin,autre',
            // 'numero_AMM' => 'required',
            // 'DCI' => 'required',
            // 'dosage' => 'required',
            // 'conditionnement' => 'required',
            // 'forme_galénique' => 'required',
            // 'laboratoire' => 'required',
            // 'voie_administration' => 'required',
            // 'classe_thérapeutique' => 'required',
            

        ]);

        $produit_sante->update($fields);

        return [
            "message"=> 'Produit mis à jour avec success',

         ];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit_sante $produit_sante)
    {
        //
        $produit_sante->delete();
        return [
            "message"=> 'Produit supprimé avec success',

         ];
    }
}
