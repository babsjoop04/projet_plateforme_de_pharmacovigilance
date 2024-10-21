<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit_sante extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];

    public function exploitation(){
        return $this->hasMany(Exploitation::class);
     }



}
