<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\ExploitantController;
use App\Http\Controllers\ExploitationController;
use App\Http\Controllers\FichiersDemandesController;
use App\Http\Controllers\ImputabiliteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TraitementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("/register", [AuthController::class,"register"]);
Route::post("/login", [AuthController::class,"login"]);
Route::post("/logout", [AuthController::class,"logout"])->middleware('auth:sanctum');

Route::middleware( 'auth:sanctum')->group(function () {

    Route::post("/gestion_utilisateur", [AuthController::class,"gerer_utilisateur"]);
    Route::apiResource("notification",NotificationController::class);
    Route::apiResource("exploitation",ExploitationController::class);
    Route::apiResource("exploitant",ExploitantController::class);
    Route::apiResource("traitement",TraitementController::class);
    Route::apiResource("imputabilite",ImputabiliteController::class);
    Route::apiResource("decision",DecisionController::class);



});

Route::get("/download", [FichiersDemandesController::class,"download"]);
Route::get("/fichiers_demandes", [FichiersDemandesController::class,"index"]);

