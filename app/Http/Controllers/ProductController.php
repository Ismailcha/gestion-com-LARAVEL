<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Products = Product::paginate(5);

        return view('commercial.listeProduit', compact('Products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('commercial.produit');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'Reference' => $request->input('Reference'),
            'Numserie' => $request->input('Numserie'),
            'LibProd' => $request->input('LibProd'),
            'NumFournisseur' => $request->input('NumFournisseur'),
            'CodeBarre' => $request->input('CodeBarre'),
            'Photo' => $request->input('Photo'),
            'Description' => $request->input('Description'),
            'PrixHT' => $request->input('PrixHT'),
            'PrixAchatHT' => $request->input('PrixAchatHT'),
            'PPCTTC' => $request->input('PPCTTC'),
            'PPHTTC' => $request->input('PPHTTC'),
            'PGTTC' => $request->input('PGTTC'),
        ];

        // Handle the photo file
        if ($request->hasFile('Photo')) {
            $photo = $request->file('Photo');

            // Validate file type
            $allowedTypes = ['png', 'jpg', 'jpeg', 'webp'];
            $extension = strtolower($photo->getClientOriginalExtension());
            if (!in_array($extension, $allowedTypes)) {
                return redirect()->back()->withErrors('Invalid file type. Only PNG, JPG, JPEG, and WEBP are allowed.');
            }

            // Generate unique file name
            $photoName = time() . '_' . $photo->getClientOriginalName();

            // Store the file
            $photo->storeAs('public/photos', $photoName);

            // Assign the file name to the 'Photo' field
            $data['Photo'] = $photoName;
        }

        try {
            // Save the data to the database
            Product::create($data);
        } catch (\Exception $e) {
            return redirect()->route('commercial.produit')->with('success', "Erreur d\'enregistrer le produit!");
        }

        // Redirect or return a response
        return redirect()->route('commercial.produit')->with('success', 'Produit enregistrer!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produit = Product::findOrFail($id);
        return view('commercial.edit_produit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $data = [
            'Reference' => $request->input('Reference'),
            'Numserie' => $request->input('Numserie'),
            'LibProd' => $request->input('LibProd'),
            'NumFournisseur' => $request->input('NumFournisseur'),
            'CodeBarre' => $request->input('CodeBarre'),
            'Description' => $request->input('Description'),
            'PrixHT' => $request->input('PrixHT'),
            'PrixAchatHT' => $request->input('PrixAchatHT'),
            'PPCTTC' => $request->input('PPCTTC'),
            'PPHTTC' => $request->input('PPHTTC'),
            'PGTTC' => $request->input('PGTTC'),
        ];

        // Handle the photo file
        if ($request->hasFile('Photo')) {
            $photo = $request->file('Photo');

            // Validate file type
            $allowedTypes = ['png', 'jpg', 'jpeg', 'webp'];
            $extension = strtolower($photo->getClientOriginalExtension());
            if (!in_array($extension, $allowedTypes)) {
                return redirect()->back()->withErrors('Invalid file type. Only PNG, JPG, JPEG, and WEBP are allowed.');
            }

            // Generate unique file name
            $photoName = time() . '_' . $photo->getClientOriginalName();

            // Store the file
            $photo->storeAs('public/photos', $photoName);

            // Assign the file name to the 'Photo' field
            $data['Photo'] = $photoName;
        }

        try {
            // Find the product by its ID
            $product = Product::findOrFail($id);

            // Update the product with the new data
            $product->update($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        // Redirect or return a response
        return redirect()->route('produit.list')->with('success', 'Produit est modifier!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('produit.list')->with('success', 'Produit est supprimer !');
    }
}
