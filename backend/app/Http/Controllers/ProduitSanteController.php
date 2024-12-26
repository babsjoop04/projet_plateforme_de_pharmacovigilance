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


    public function downloadNotice(Request $request)
    {
        //
        // return Produit_sante::all();
        $fields = $request->validate([
            'id' => 'required',
        ]);

        $produit = Produit_sante::where('id',$fields["id"])->first();

        $link = public_path("storage/uploads/{$produit->notice}");
        if (file_exists($link)) {

            return response()->download($link, $produit->notice,[
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="document.pdf"',
                'X-Filename'=> $produit->notice]);
            // return "fichier trouvé";
        } else {

            abort(404, 'Fichier non trouvé');
        }


        // return $fields;

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
            'file_img_produit' => 'required|file|mimes:jpg,png,jpeg',
            'file_notice_produit' => 'required|file|mimes:pdf',
        ]);


        $file_img_produit = $request->file('file_img_produit');
        if ($file_img_produit) {


            $fileName =  "img_produit" . '_' . $fields["numero_AMM"] . '_' . $fields["nom_produit"]  . '.' . $file_img_produit->getClientOriginalExtension();
            $file_img_produit->storeAs('uploads', $fileName, "public");
            $fields["img_produit"] = $fileName;
        } else {
            $fields["img_produit"] = null;
        }

        $file_notice = $request->file('file_notice_produit');


        if ($file_notice) {


            $fileName =  "notice_produit" . '_' . $fields["numero_AMM"] . '_' . $fields["nom_produit"]  . '.' . $file_notice->getClientOriginalExtension();
            $file_notice->storeAs('uploads', $fileName, "public");
            $fields["notice"] = $fileName;
        } else {
            $fields["notice"] = null;
        }

        unset($fields["file_img_produit"]);
        unset($fields["file_notice_produit"]);

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
