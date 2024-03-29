<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuPeriksa extends Model
{
    use HasFactory;
    public $primaryKey = 'periksaID';
    protected $guarded = [];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'pesertaID', 'pesertaID');
    }
}
