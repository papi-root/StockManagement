<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produit;
use PDF;
use DB;
use App\Vente;
use App\Ventes1;
use Session;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produits = Produit::all();

        return view('facture.index')->with('produits', $produits);
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

    public function facturePDF($serveuse, $table_chaise, $tcs)
    {

      if($table_chaise == 'undefined')
      {
        Session::flash('info', 'Veuillez selectionnez table ou chaise !');

        return redirect()->back();
      }

      $produits = DB::table('produits')
      ->join('ventes', 'produits.id', '=', 'ventes.id_produit')
      ->select('produits.libelle', 'produits.prix', 'ventes.id', 'ventes.quantite', 'ventes.montant')
      ->orderBy('ventes.created_at', 'desc')
      ->where('ventes.reglement', '=', 0)->get();


      //$pdf = PDF::loadView('facture', compact('produits'));

      $ventes = Vente::all();
      foreach($ventes as $v)
      {
        if($v->reglement == 0)
        {
          $v->reglement = 1;
          $v->serveuse = $serveuse;
          $v->place = $table_chaise . ' ' .$tcs;
          $v->save();
        }
      }


      //return $pdf->download('facture.pdf');
      return view('facture')->with('produits', $produits)->with('serveuse', $serveuse)
      ->with('table_chaise', $table_chaise)->with('tcs', $tcs);
    }
}
