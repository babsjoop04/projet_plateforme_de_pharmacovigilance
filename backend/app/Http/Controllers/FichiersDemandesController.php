<?php

namespace App\Http\Controllers;

use App\Models\FichiersDemandes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FichiersDemandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return FichiersDemandes::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function upload(Request $request)
    {
        //
        // $file = $request->file('file');
        // $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        // $file->storeAs('uploads', $fileName);

        // Fil::create([
        //     'original_name' => $file->getClientOriginalName(),
        //     'generated_name' => $fileName,
        // ]);

        // return [
        //     'message' => 'Fichier(s) enregistré(s) avec success'
        // ];
    }

    /**
     * Display the specified resource.
     */
    public function download(Request $request)

    {
        // FichiersDemandes $fichiersDemandes
        //

        $fichiersDemandes=FichiersDemandes::where("nom_fichiers",$request->nom_fichiers)->first();
        // return $fichiersDemandes->user;
        if (!$fichiersDemandes) {

            return [
                "error"=> [
                    "enregistrement"=> "Aucun enregistrement ne correspond",
                ]
            ];
        }
        // return $fichiersDemandes;


        // return file_exists(public_path("storage/uploads/{$fichiersDemandes->nom_fichiers}"));

        
        $link=public_path("storage/uploads/{$fichiersDemandes->nom_fichiers}");
        if (file_exists($link)) {
            return response()->download($link, $fichiersDemandes->nom_fichiers);
            // return "fichier trouvé";
        } else {

            abort(404, 'Fichier non trouvé');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateFichiers(Request $request, FichiersDemandes $fichiersDemandes)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FichiersDemandes $fichiersDemandes)
    {
        //
    }
}
