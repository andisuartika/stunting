<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getKabupaten(){
        $client = new \GuzzleHttp\Client(); 
        $response = $client->get('https://api.binderbyte.com/wilayah/kabupaten?api_key=47b1a358e9071362c46ecfa3e9d624ea13facbefe961e8f0419779623f5ddcf0&id_provinsi=51');

        $result = json_decode($response->getBody());
        foreach($result->value as $kabupaten){
            $newKabupaten = Kabupaten::updateOrCreate([
                'kabupatenID' => $kabupaten->id,
            ],[
                'namaKabupaten' => $kabupaten->name,
                'provinsiID' => $kabupaten->id_provinsi, 
            ]);
        }

        echo 'SUCCES';
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsiID', 'provinsiID');
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'kecamatanID', 'kecamatanID');
    }
}
