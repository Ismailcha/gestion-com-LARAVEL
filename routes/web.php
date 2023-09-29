<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BonDeSortieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommerciauxController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VisiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    Route::get('/liste-utilisateur', [AdminController::class, 'showList'])->name('admin.liste_utilisateur');
    Route::get('/ajouter_commerciaux', [AdminController::class, 'showAddCommercial'])->name('ajouter_commerciaux');
    Route::post('/ajouter_commerciaux', [CommerciauxController::class, 'store'])->name('commerciaux.store');

    // commercial data 
    Route::get('/commercial_detail/{id}', [CommerciauxController::class, 'show'])->name('commercial.detail');
    Route::get('/commercial/{id}/edit', [CommerciauxController::class, 'edit'])->name('commercial.edit');
    Route::put('/commercial/{id}', [CommerciauxController::class, 'update'])->name('commercial.update');
    Route::delete('/commercial/{id}', [CommerciauxController::class, 'destroy'])->name('commercial.destroy');
});

Route::prefix('commercial')->middleware('auth')->group(function () {
    Route::get('accueil', function () {
        return view('commercial.accueil');
    })->name('commercial.outils');
    // PRODUIT
    Route::get('produit', [ProductController::class, 'create'])->name('commercial.produit');
    Route::get('/liste_produit', [ProductController::class, 'index'])->name('produit.list');
    Route::get('/produit/{produit}/edit', [ProductController::class, 'edit'])->name('produit.edit');
    Route::put('/produit/{produit}', [ProductController::class, 'update'])->name('commercial.produit.update');
    Route::delete('/liste_produit/{id}', [ProductController::class, 'destroy'])->name('produit.delete');
    route::post('/produit', [ProductController::class, 'store'])->name('produit.submit');
    // visite
    Route::get('/visites', [VisiteController::class, 'create'])->name('commercial.visite_effectuer');
    Route::get('/visites', [VisiteController::class, 'index'])->name('visite.index');
    route::get('/visite_effectuer', [VisiteController::class, 'showClientInvisite'])->name('commercial.visite_effectuer');
    route::post('/visite_effectuer', [VisiteController::class, 'store'])->name('visite.submit');
    Route::get('/visites/{id}/edit', [VisiteController::class, 'edit'])->name('visite.edit');
    Route::delete('/visites/{id}', [VisiteController::class, 'destroy'])->name('visite.delete');
    Route::put('/visite/{visite}', [VisiteController::class, 'update'])->name('visite.update');

    // add client
    Route::get('ajout_client', [ClientController::class, 'create'])->name('commercial.ajout_client');
    route::post('/ajout_client', [ClientController::class, 'store'])->name('client.store');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{NumClient}/detail', [ClientController::class, 'detail'])->name('client.detail');
    Route::get('/clients/{NumClient}/edit', [ClientController::class, 'edit'])->name('commercial.edit_client');
    Route::put('/clients/{NumClient}', [ClientController::class, 'update'])->name('commercial.client.update');
    Route::delete('/clients/{NumClient}', [ClientController::class, 'destroy'])->name('client.destroy');

    // create bande de commande
    Route::get('/bande_commande/{id}', [BonDeSortieController::class, 'show'])->name('commercial.bandecommande');
    Route::get('bande_commande', [BonDeSortieController::class, 'create'])->name('commercial.ajout_bandeCommande');
    route::post('/bande_commande', [BonDeSortieController::class, 'store'])->name('bandeCommande.store');
    Route::get('/liste_bandeCommande', [BonDeSortieController::class, 'liste'])->name('bandeCommande.liste');
    Route::delete('/bandeCommande/{id}', [BonDeSortieController::class, 'destroy'])->name('bandeCommande.destroy');
    Route::get('/generate-pdf/{id}', [BonDeSortieController::class, 'generatePDF'])->name('generate.pdf');


    // location tracking 
    Route::post('/commercial/location', [CommerciauxController::class, 'storeLocation']);
    Route::get('/commercial/last-location', [CommerciauxController::class, 'getLastLocation']);
});


Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 1) {
            // Redirect the admin to the admin dashboard
            return redirect()->route('admin.dashboard');
        } else {
            // Redirect other users to the home page or commercial dashboard
            return redirect()->route('commercial.outils');
        }
    } else {
        // If not logged in, show the login page
        return view('auth.login');
    }
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
