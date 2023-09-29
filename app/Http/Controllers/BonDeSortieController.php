<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\bonDeSortie;
use Illuminate\Http\Request;
use App\Models\BandeCommandeProduit;
use Termwind\Components\Dd;
use PDF;

class BonDeSortieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve products from the database
        $products = Product::all();
        $clients = Client::all();

        // Pass the products variable to the view
        return view('commercial.ajout_bandeCommande', compact('clients', 'products'));
    }
    public function liste()
    {
        $bandeSorties = BonDeSortie::with('produits')->get();

        return view('commercial.liste_bandeCommande', compact('bandeSorties'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required',
            'Date' => 'required',
            'TotalHT' => 'required',
            'Observations' => 'nullable',
            'commercial_id' => 'required',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:produit,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);
        $totalHT = 0;
        foreach ($validatedData['products'] as $product) {
            $quantity = $product['quantity'];
            $price = Product::where('id', $product['product_id'])->value('PrixHT');
            $subtotal = $quantity * $price;
            $totalHT += $subtotal;
        }

        // Create a new BandeCommande instance with the validated data
        $bonDeSortie = BonDeSortie::create([
            'commercial_id' => $validatedData['commercial_id'],
            'client_id' => $validatedData['client_id'],
            'Date' => $validatedData['Date'],
            'TotalHT' => $totalHT,
            'Observations' => $validatedData['Observations'],
        ]);

        // Create BandeCommandeProduit records for each product
        foreach ($validatedData['products'] as $product) {
            $quantite = $product['quantity'];

            // Create a new BandeCommandeProduit instance with the product ID and quantity
            BandeCommandeProduit::create([
                'bon_de_sortie_id' => $bonDeSortie->id,
                'product_id' => $product['product_id'],
                'quantite' => $quantite,
            ]);
        }

        // Redirect or return a response indicating success
        return redirect()->route('bandeCommande.liste')->with('success', 'Bande Commande est bien crée!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bonDeSortie = bonDeSortie::with('produits')->findOrFail($id); // Fetch a bon_de_sortie record by ID
        return view('commercial.detail_bandecommande', compact('bonDeSortie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bonDeSortie = bonDeSortie::findOrFail($id);
        $bonDeSortie->delete();

        return redirect()->route('bandeCommande.liste')->with('success', 'Bande Commande est bien supprimée!');
    }
    public function generatePDF($id)
    {
        $bonDeSortie = BonDeSortie::with('produits')->findOrFail($id);

        $pdf = PDF::loadView('commercial.pdfbondesortie', compact('bonDeSortie'));

        return $pdf->stream('bon_de_sortie.pdf');
    }
}
