<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BandeCommandeProduit extends Model
{
    use HasFactory;
    protected $table = 'bande_commande_produits';
    protected $fillable = [
        'bon_de_sortie_id',
        'product_id',
        'quantite',
    ];
    public function bonDeSortie()
    {
        return $this->belongsTo(BonDeSortie::class);
    }

    public function product()
    {
        return $this->belongsTo(Produit::class);
    }
}
