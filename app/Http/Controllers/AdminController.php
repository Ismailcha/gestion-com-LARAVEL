<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Visite;
use App\Models\Product;
use App\Models\bonDeSortie;
use App\Models\Commercials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BandeCommandeProduit;

class AdminController extends Controller
{

    public function showAddCommercial()
    {
        return view('admin.add_commercial');
    }
    public function mostSoldProduct()
    {
        // Logic to retrieve the most sold product data
        $mostSoldProduct = BandeCommandeProduit::select('product_id', DB::raw('SUM(quantite) as totalQuantity'))
            ->groupBy('product_id')
            ->orderByDesc('totalQuantity')
            ->first();

        if ($mostSoldProduct) {
            $product = Product::find($mostSoldProduct->product_id);

            return [
                'productName' => $product->Reference, // Get the product name from the Product model
                'totalQuantity' => $mostSoldProduct->totalQuantity,
            ];
        }

        return null;
    }
    public function mostProfitableProduct()
    {
        // Logic to retrieve the most profitable product data
        $mostProfitableProduct = BandeCommandeProduit::select('product_id', DB::raw('SUM(quantite * PrixHT) as totalProfit'))
            ->join('produit', 'bande_commande_produits.product_id', '=', 'produit.id')
            ->groupBy('product_id')
            ->orderByDesc('totalProfit')
            ->first();

        if ($mostProfitableProduct) {
            $product = Product::find($mostProfitableProduct->product_id);

            return [
                'productName' => $product->Reference,
                'totalProfit' => $mostProfitableProduct->totalProfit,
            ];
        }

        return null;
    }
    public function showDashboard()
    {
        $bonDeSortie = bonDeSortie::count();
        $client = Client::count();
        $commercials = Commercials::count();
        $produit = Product::count();
        $visite = Visite::count();
        $mostSoldProductData = $this->mostSoldProduct();
        $mostProfitableProduct = $this->mostProfitableProduct();
        return view('admin.admin_dashboard', compact('bonDeSortie', 'client', 'commercials', 'produit', 'visite', 'mostSoldProductData', 'mostProfitableProduct'));
    }
    public function showList()
    {
        $admins = User::where('role', 1)->get();
        $commerciaux = Commercials::all();

        return view('admin.liste_utilisateur', compact('admins', 'commerciaux'));
    }
}
