<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BayiPeriksa extends Model
{
    use HasFactory;
    protected $primaryKey = 'periksaID';
    protected $guarded = [];
    protected $casts = [
        'imunisasiID' => 'array'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'pesertaID', 'pesertaID');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyanduID','posyanduID');
    }

    public function imunisasi()
    {
        return $this->belongsTo(Imunisasi::class, 'imunisasiID','imunisasiID');
    }

    public function userID()
    {
        return $this->belongsTo(User::class, 'userID','id');
    }

}
