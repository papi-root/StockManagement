<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ventes1 extends Model
{
    //
    protected $fillable = [
      'id_produit', 'quantite', 'montant', 'reglement', 'mois', 'jour', 'caissier'
    ];
}
