<?php

namespace App\Http\Controllers;

use App\Models\Aggregation_notification_produit_sante;

use Illuminate\Http\Request;

class AggregationNotificationProduitSanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            
        ]);


        /*
          [
        // "id_notification", 
        // "id_produit_sante", 
        //eeim
        "posologie",
        "date_debut_prise", 
        "date_fin_prise",       

        //mapi
        "date_ouverture_flacon" ,
         "date_vaccination" ,
        "site_administration" ,
        "nombre_contact_vaccin" ,
        "nom_solvant", 
        "date_peremption_solvant",
        "numero_lot_solvant",

        "numero_lot", 
        "provenance" ,
        "date_peremption", 
        
    ] 
         */

    }

    /**
     * Display the specified resource.
     */
    public function show(Aggregation_notification_produit_sante $aggregation_notification_produit_sante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aggregation_notification_produit_sante $aggregation_notification_produit_sante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aggregation_notification_produit_sante $aggregation_notification_produit_sante)
    {
        //
    }
}
