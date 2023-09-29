<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bonDeSortie extends Model
{
    use HasFactory;
    protected $table = 'bon_de_sortie';
    protected $fillable = [
        'commercial_id',
        'Date',
        'TotalHT',
        'Observations',
        'client_id'
    ];
    public function commercial()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'NumClient');
    }
    public function produits()
    {
        return $this->belongsToMany(Product::class, 'bande_commande_produits');
    }
}
