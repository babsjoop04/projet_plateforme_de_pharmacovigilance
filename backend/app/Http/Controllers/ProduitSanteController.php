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
    public function rechercher(Request $request)
    {
        //
        // return Produit_sante::all();
        $fields = $request->validate([
            'nom_produit' => 'required',
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


        // return $fields;

        return Produit_sante::whereLike('nom_produit', "%" . $fields["nom_produit"] . "%",)->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([
            'nom_produit' => 'required',
            'type_produit' => 'required|in:medicament,vaccin,autre',
            'numero_AMM' => 'required',
            'DCI' => 'required',
            'dosage' => 'required',
            'date_début' => 'required|date',
            'prix_public' => 'required',
            'conditionnement' => 'required',
            'forme_galénique' => 'required',
            'laboratoire' => 'required',
            'voie_administration' => 'required',
            'classe_thérapeutique' => 'required',


        ]);


        Produit_sante::create($fields);

        return [
            "message" => 'Produit ajouté avec success',

        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit_sante $produit)
    {
        //
        // $produit_sante
        return $produit;
        // [
        //     "message" =>"hello"
        // ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit_sante $produit)
    {
        //
        $fields = $request->validate([
            'nom_produit' => 'required',
            'type_produit' => 'required|in:medicament,vaccin,autre',
            'numero_AMM' => 'required',
            'DCI' => 'required',
            'dosage' => 'required',
            'date_début' => 'required|date',
            'prix_public' => 'required',
            'conditionnement' => 'required',
            'forme_galénique' => 'required',
            'laboratoire' => 'required',
            'voie_administration' => 'required',
            'classe_thérapeutique' => 'required',
        ]);

        $produit->update($fields);

        return
            // $produit;
            [
                "message" => 'Produit mis à jour avec success',
                "produit" => $produit

            ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit_sante $produit)
    {
        //
        $produit->delete();
        return [
            "message" => 'Produit supprimé avec success',

        ];
    }
}
