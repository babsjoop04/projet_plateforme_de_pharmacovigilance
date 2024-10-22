<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imputabilite extends Model
{
    use HasFactory;
    protected $fillable = [
        "traitement_id",
        "classification",
    ] ;
    public function traitement(){
        return $this->hasOne(Traitement::class);
     }
}
