<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    //
      protected $fillable = ['id_entree', 'quantite', 'montant', 'created_at', 'updated_at'];
}
