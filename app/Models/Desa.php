<?php

namespace App\Models;

use App\Models\Desa as ModelsDesa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getDesa(){
        $client = new \GuzzleHttp\Client(); 
        $kecamatan = Kecamatan::all();
        foreach($kecamatan as $kec){
            $response = $client->get('https://api.binderbyte.com/wilayah/kelurahan?api_key=47b1a358e9071362c46ecfa3e9d624ea13facbefe961e8f0419779623f5ddcf0&id_kecamatan='.$kec->kecamatanID);
            $result = json_decode($response->getBody());
            
            foreach($result->value as $desa){
                $newDesa = ModelsDesa::updateOrCreate([
                    'desaID' => $desa->id,
                ],[
                    'namaDesa' => $desa->name,
                    'kecamatanID' => $desa->id_kecamatan,
                ]);
            }
        }

        echo 'SUCCESS';
    }

    public function posyandu()
    {
        return $this->hasMany(Posyandu::class, 'desaID', 'desaID');
    }

    public function kecamatan()
    {
        return $this->hasMany(Posyandu::class, 'desaID', 'desaID');
    }

}
