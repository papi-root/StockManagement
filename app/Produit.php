<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //
    protected $fillable = ['libelle', 'prix', 'id_categorie', 'lieu', 'created_at', 'updated_at']; 
}
