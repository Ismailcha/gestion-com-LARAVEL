<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commercials extends Model
{
    use HasFactory;
    protected $table = 'commerciaux';
    protected $primaryKey = 'IDDelegue';
    protected $fillable = [
        'nomDel',
        'CIN',
        'CNSSDel',
        'AdresseDel',
        'NumCaGrise',
        'NumPC',
        'Poste',
        'DateEmb',
        'Qualié',
        'Affecaions',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function visites()
    {
        return $this->hasMany(visite::class, 'commercial_id');
    }
    public function bonDeSorties()
    {
        return $this->hasMany(BonDeSortie::class);
    }
}
