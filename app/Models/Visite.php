<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;
    protected $table = 'visite';
    public function client()
    {
        return $this->belongsTo(Client::class, 'NumClient', 'NumClient');
    }
    public function commercial()
    {
        return $this->belongsTo(Commercials::class, 'commercial_id');
    }
    protected $fillable = [
        'Identifiant',
        'Date',
        'Duree',
        'NumClient',
        'commercial_id',
        'Observation',
    ];
}
