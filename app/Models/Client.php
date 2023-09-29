<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    protected $primaryKey = 'NumClient';

    protected $fillable = [
        'Pharmacie',
        'CodePostal',
        'NomClient',
        'Prénom',
        'Adresse',
        'Ville',
        'Pays',
        'Telephone',
        'Fax',
        'EMail',
        'Type',
        'Observations',
        'Plan',
    ];
    public function visites()
    {
        return $this->hasMany(visite::class, 'NumClient', 'NumClient');
    }
    public function bonDeSorties()
    {
        return $this->hasMany(BonDeSortie::class);
    }
    public function showAllClients()
    {
        $clients = Client::all(); // Fetch all clients from the database
        return view('clients.index', compact('clients'));
    }
}
