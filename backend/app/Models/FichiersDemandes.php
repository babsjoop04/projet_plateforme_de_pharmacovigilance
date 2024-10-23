<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichiersDemandes extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "nom_fichiers"
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
