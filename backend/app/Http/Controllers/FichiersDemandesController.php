<?php

namespace App\Http\Controllers;

use App\Models\FichiersDemandes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\File;
use App\Models\User;
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
        $user = User::where('email', $request->email)->first();


        $fichier = $user->fichiersdemande()->whereLike("nom_fichiers",$request->type."%")->first();

        // return $fichiers;

        if (!$fichier) {

            return [
                "error" => [
                    "enregistrement" => "Aucun enregistrement ne correspond",
                ]
            ];
        }



        $link = public_path("storage/uploads/{$fichier->nom_fichiers}");
        if (file_exists($link)) {

            return response()->download($link, $fichier->nom_fichiers,['X-Filename'=> $fichier->nom_fichiers]);
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
