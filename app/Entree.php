<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    //
    protected $fillable = ['libelle', 'prix', 'quantite', 'montant', 'mois', 'created_at', 'updated_at'];
}
