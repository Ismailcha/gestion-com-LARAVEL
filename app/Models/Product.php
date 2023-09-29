<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'produit';
    protected $fillable = [
        'Reference',
        'Numserie',
        'LibProd',
        'NumFournisseur',
        'Photo',
        'CodeBarre',
        'PrixHT',
        'PrixAchatHT',
        'PPCTTC',
        'PPHTTC',
        'PGTTC',
    ];
    public function bandeCommandes()
    {
        return $this->belongsToMany(bonDeSortie::class, 'bande_commande_produits');
    }
}
