<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vente;
use App\Ventes1;
use App\Produit;
use DB;
use Carbon\Carbon;
use Auth;
class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sorties = DB::table('produits')
        ->join('ventes', 'produits.id', '=', 'ventes.id_produit')
        ->join('users', 'users.id', '=', 'ventes.id_user')
        ->select('produits.libelle', 'produits.prix', 'ventes.id', 'ventes.quantite', 'ventes.montant', 'users.prenom', 'users.nom', 'ventes.serveuse', 'ventes.place', 'ventes.created_at')
        ->orderBy('id', 'desc')
        ->where('ventes.reglement', '=', 2)->get();

        return view('vente.index')->with('sorties', $sorties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $id = (int) $request->id;
        $produit = Produit::find($id);
        $qte = (int) $request->qte;

        $total = $produit->prix * $qte;

        $now =  Carbon::now()->toTimeString();
        $yest = Carbon::now();

        if( Carbon::parse($now) > Carbon::parse('00:00:00') && Carbon::parse($now) < Carbon::parse('06:30:00'))
        {
          $yest = Carbon::now()->subday();
        }

        Vente::create([
          'id_produit' => $id,
          'quantite' => $qte,
          'montant' => $total,
          'reglement' => 0,
          'mois' => $yest->year .'-'. $yest->month,
          'jour' => $yest->year .'-'. $yest->month .'-'.  $yest->day,
          'id_user' => Auth::user()->id,
          'serveuse' => ' ',
          'place' => ' '
        ]);

        return response()->json($produit);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
