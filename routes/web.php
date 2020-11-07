<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
  Route::get('/home', 'HomeController@index')->name('home');

  Route::resource('/produit', 'ProduitController');

  Route::get('produit-delete', [
    'uses' => 'ProduitController@destroy',
    'as' => 'produit.destroy'
  ]);

  Route::get('/produit-AQte', [
      'uses' => 'ProduitController@ajouterQte',
      'as' => 'produit.AQte'
  ]);
  Route::post('/modifier/{id}', [
    'uses' => 'ProduitController@modifier',
    'as' => 'produit.modifier'
  ]);

  Route::resource('/facture', 'FactureController');

  Route::resource('/vente', 'VenteController');

  Route::resource('/panier', 'PanierController');

  Route::get('/facture-pdf/{serveuse}/{table_chaise}-{tcs}', [
    'uses' => 'FactureController@facturePDF'
  ]);

  Route::resource('/entrees', 'EntreeController');

  Route::post('/entrees-supprimer', [
    'uses' => 'EntreeController@supprimer',
    'as' => 'entrees.supprimer'
  ]);

  Route::post('/entree-modifier/{id}', [
    'uses' => 'EntreeController@modifier',
    'as' => 'entree.modifier'
  ]);

  Route::resource('/sorties', 'SortieController');

  Route::resource('/categorie', 'CategorieController');

  Route::post('/categories/{id}', [
    'uses' => 'CategorieController@modifier',
    'as' => 'categorie.modifier'
  ]);

  Route::get('/supprimer', [
    'uses' => 'CategorieController@supprimer',
    'as' => 'categorie.supprimer'
  ]);

  Route::resource('/utilisateur', 'UtilisateurController');

  Route::post('/utilisateur/{id}/modifier', [
    'uses' => 'UtilisateurController@modifier',
    'as' => 'utilisateur.modifier'
  ]);

  Route::post('/utilisateur-supprimer', [
    'uses' => 'UtilisateurController@supprimer',
    'as' => 'utilisateur.supprimer'
  ]);

  Route::resource('/profil', 'ProfilController');

  Route::resource('/accueil', 'AccueilController');

  Route::resource('/stock', 'StockController');

  Route::resource('/total', 'TotalController');

  Route::get('/details/{jour}', [
    'uses' => 'TotalController@details',
    'as' => 'total.details'
  ]);

  Route::get('/total-caissier', [
    'uses' => 'TotalController@totalCaissier',
    'as' => 'total.caissier'
  ]);

  Route::get('/detailsCaissier/{jour}/{caissier}', [
    'uses' => 'TotalController@detailsCaissier',
    'as' => 'total.detailsCaissier'
  ]);

  Route::resource('/reglement', 'ReglementCOntroller');

  Route::post('/reglement/confirmer', [
    'uses' => 'ReglementController@confirmer'
  ]);

  Route::resource('/serveuses', 'ServeuseController');

  Route::post('/serveuse/modifier/{id}', [
    'uses' => 'ServeuseController@modifier',
    'as' => 'serveuses.modifier'
  ]);

  Route::post('/serveuse-supprimer', [
    'uses' => 'ServeuseController@supprimer',
    'as' => 'serveuses.supprimer'
  ]);

  Route::get('/serveuse/{id}/modifier', [
    'uses' => 'ServeuseController@edit',
    'as' => 'serveuses.edit'
  ]);

  Route::post('/reglement/confirmer', [
    'uses' => 'ReglementController@confirmer',
    'as' => 'reglement.confirmer'
  ]);

});
