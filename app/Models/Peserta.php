<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $primaryKey = 'pesertaID';
    protected $guarded = [];

    public function ibuPeriksa()
    {
        return $this->hasMany(IbuPeriksa::class, 'pesertaID', 'pesertaID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function bayiPeriksa()
    {
        return $this->hasMany(User::class, 'pesertaID', 'pesertaID');
    }
}
