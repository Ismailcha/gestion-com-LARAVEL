<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(5);
        return view('commercial.listeClient', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('commercial.ajout_client');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'Pharmacie' => $request->input('Pharmacie'),
            'CodePostal' => $request->input('CodePostal'),
            'NomClient' => $request->input('NomClient'),
            'Prénom' => $request->input('Prénom'),
            'Adresse' => $request->input('Adresse'),
            'Ville' => $request->input('Ville'),
            'Pays' => $request->input('Pays'),
            'Telephone' => $request->input('Telephone'),
            'Fax' => $request->input('Fax'),
            'EMail' => $request->input('EMail'),
            'Type' => $request->input('Type'),
            'Observations' => $request->input('Observations'),
            'Plan' => $request->input('Plan'),
        ];

        try {
            // Save the data to the database
            Client::create($data);
        } catch (\Exception $e) {
            return redirect()->route('commercial.ajout_client')->with('success', "Erreur lors de l'ajout du client");
        }

        return redirect()->route('commercial.ajout_client')->with('success', 'Client a été bien ajouter!');
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
        $client = Client::findOrFail($id); // Retrieve the client by ID or throw an exception if not found

        return view('commercial.edit_client', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $data = [
            'Pharmacie' => $request->input('Pharmacie'),
            'CodePostal' => $request->input('CodePostal'),
            'NomClient' => $request->input('NomClient'),
            'Prénom' => $request->input('Prénom'),
            'Adresse' => $request->input('Adresse'),
            'Ville' => $request->input('Ville'),
            'Pays' => $request->input('Pays'),
            'Telephone' => $request->input('Telephone'),
            'Fax' => $request->input('Fax'),
            'EMail' => $request->input('EMail'),
            'Type' => $request->input('Type'),
            'Observations' => $request->input('Observations'),
            'Plan' => $request->input('Plan'),
        ];

        try {
            $client->update($data);
        } catch (\Exception $e) {
            return redirect()->route('clients.index')->with('success', 'Erreur lors de la modification!');
        }

        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);

        // Delete the client
        $client->delete();

        // Redirect to the client list with a success message
        return redirect()->route('clients.index')->with('success', 'Client a été supprimé!');
    }
    public function detail(string $NumClient)
    {
        $client = Client::findOrFail($NumClient);
        return view('commercial.client_detail', compact('client'));
    }
}
