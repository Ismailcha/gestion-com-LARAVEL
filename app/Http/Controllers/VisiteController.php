<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Visite;
use Illuminate\Http\Request;

class VisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visites = Visite::paginate(10); // Adjust the pagination limit as per your requirement

        return view('commercial.listevisite', ['visites' => $visites]);
    }
    public function showClientInvisite()
    {
        $clients = Client::all();

        return view('commercial.visite_effectuer', ['clients' => $clients]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('commercial.visite_effectuer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'Identifiant' => $request->input('Identifiant'),
            'Date' => $request->input('Date'),
            'Duree' => $request->input('Duree'),
            'NumClient' => $request->input('NumClient'),
            'Observation' => $request->input('Observation'),
            'commercial_id' => auth()->user()->commercial->IDDelegue,
        ];
        try {
            // Save the data to the database
            Visite::create($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('visite.index')->with('success', 'Visite a été bien crée!');
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
        $visite = Visite::findOrFail($id);
        $clients = Client::all(); // Retrieve all clients for the dropdown

        return view('commercial.edit_visite', compact('visite', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Find the visite by ID
            $visite = Visite::findOrFail($id);

            // Update the visite with the request data
            $visite->update([
                'Identifiant' => $request->input('identifiant'),
                'Date' => $request->input('date'),
                'Duree' => $request->input('duree'),
                'Observation' => $request->input('observation'),
                'Latitude' => $request->input('latitude'),
                'Longitude' => $request->input('longitude'),
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        // Redirect to the list of visites with a success message
        return redirect()->route('visite.index')->with('success', 'Visite actualisée avec succès!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visite = Visite::findOrFail($id);
        $visite->delete();

        return redirect()->route('visite.index')->with('success', 'Visite supprimée avec succès!');
    }
}
