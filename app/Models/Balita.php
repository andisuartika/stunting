<?php

namespace App\Models;

use App\Models\Peserta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balita extends Model
{
    use HasFactory;
    protected $table = 'pesertas';
    protected $primaryKey = 'pesertaID';
    protected $guarded = [];

    public function ibu()
    {
        return $this->belongsTo(Peserta::class, 'pesertaID', 'ibuID');
    }
}
