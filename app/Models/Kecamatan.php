<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class Kecamatan extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public static function getKecamatan(){
        $client = new \GuzzleHttp\Client(); 
        $kabupaten = Kabupaten::all();
        foreach($kabupaten as $kab){
            $response = $client->get('https://api.binderbyte.com/wilayah/kecamatan?api_key=47b1a358e9071362c46ecfa3e9d624ea13facbefe961e8f0419779623f5ddcf0&id_kabupaten='.$kab->kabupatenID);
            $result = json_decode($response->getBody());
            
            foreach($result->value as $kecamatan){
                $newKecamatan = Kecamatan::updateOrCreate([
                    'kecamatanID' => $kecamatan->id,
                ],[
                    'namaKecamatan' => $kecamatan->name,
                    'kabupatenID' => $kecamatan->id_kabupaten,
                ]);
            }
        }

        echo 'SUCCESS';
    }

    public function desa()
    {
        return $this->hasMany(Desa::class, 'desaID', 'desaID');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupatenID', 'kabupatenID');
    }
}
