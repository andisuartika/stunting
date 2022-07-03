<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bayiPeriksa()
    {
        return $this->hasMany(BayiPeriksa::class, 'posyanduID', 'posyanduID');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desaID', 'desaID');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'posyanduID', 'posyanduID');
    }
}
