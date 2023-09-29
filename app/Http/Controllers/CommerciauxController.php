<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Commercials;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommerciauxController extends Controller
{

    public function store(Request $request)
    {

        // $validatedData = $request->validate([
        //     // rules of validation for later
        // ]);

        // Create a new user
        $user = User::create([
            'name' => $request->input('nomDel'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        // Create a new commerciaux
        $commerciaux = Commercials::create([
            'nomDel' => $request->input('nomDel'),
            'CIN' => $request->input('CIN'),
            'CNSSDel' => $request->input('CNSSDel'),
            'AdresseDel' => $request->input('AdresseDel'),
            'NumCaGrise' => $request->input('NumCaGrise'),
            'NumPC' => $request->input('NumPC'),
            'Poste' => $request->input('Poste'),
            'DateEmb' => $request->input('DateEmb'),
            'Qualié' => $request->input('Qualié'),
            'Affecaions' => $request->input('Affecaions'),
            'user_id' => $user->id,
        ]);


        return redirect()->back()->with('success', 'Compte pour déléguer a été bien crée');
    }
    public function show($id)
    {
        // Retrieve the commercial by ID
        $commercial = Commercials::findOrFail($id);

        // Retrieve the last recorded location for the commercial
        $lastLocation = UserLocation::where('user_id', $commercial->user_id)
            ->latest('created_at')
            ->first();

        // Retrieve all user locations for the commercial
        $userLocations = UserLocation::where('user_id', $commercial->user_id)
            ->take(20)
            ->get();

        return view('admin.commercial_details', compact('commercial', 'lastLocation', 'userLocations'));
    }


    public function storeLocation(Request $request)
    {
        // Retrieve the latitude and longitude values from the request
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Get the authenticated user
        $user = Auth::user();

        // Create a new user location record
        UserLocation::create([
            'user_id' => $user->id,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
    public function edit($id)
    {
        $commercial = Commercials::findOrFail($id);
        return view('admin.edit_commercial', compact('commercial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomDel' => 'required',
            'CIN' => 'required',
            'CNSSDel' => 'required',
            'AdresseDel' => 'required',
            'NumCaGrise' => 'required',
            'NumPC' => 'required',
            'Poste' => 'required',
            'DateEmb' => 'required',
            'Qualié' => 'required',
            'Affecaions' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:2|confirmed',
        ]);

        $commercial = Commercials::findOrFail($id);
        $commercial->nomDel = $request->input('nomDel');
        $commercial->CIN = $request->input('CIN');
        $commercial->CNSSDel = $request->input('CNSSDel');
        $commercial->AdresseDel = $request->input('AdresseDel');
        $commercial->NumCaGrise = $request->input('NumCaGrise');
        $commercial->NumPC = $request->input('NumPC');
        $commercial->Poste = $request->input('Poste');
        $commercial->DateEmb = $request->input('DateEmb');
        $commercial->Qualié = $request->input('Qualié');
        $commercial->Affecaions = $request->input('Affecaions');
        $commercial->user->email = $request->input('email');

        if ($request->filled('password')) {
            $commercial->user->password = Hash::make($request->input('password'));
        }

        $commercial->user->save();
        $commercial->save();

        return redirect()->route('admin.liste_utilisateur');
    }
    public function destroy($id)
    {
        $commercial = Commercials::findOrFail($id);
        $commercial->delete(); // Delete commercial record

        return redirect()->route('admin.liste_utilisateur')->with('success', 'Déléguer supprimé avec succès');
    }
    public function getLastLocation()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the last recorded location for the user
        $lastLocation = UserLocation::where('user_id', $user->id)
            ->latest('created_at')
            ->first();

        // Return the last recorded location
        return response()->json($lastLocation);
    }
}
