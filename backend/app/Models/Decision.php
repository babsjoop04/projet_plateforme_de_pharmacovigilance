<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    use HasFactory;
    protected $fillable = [
        "traitement_id",
        "decision",
    ] ;

    public function traitement(){
        return $this->hasOne(Traitement::class);
     }
}
