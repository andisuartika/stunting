<?php

namespace App\Http\Livewire;

use App\Models\BayiPeriksa;
use App\Models\Imunisasi;
use App\Models\Peserta;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BalitaIndex extends Component
{
    public $idIbu;
    public $nama;
    public $NIK;
    public $tglLahir;
    public $balita;
    public $NIKBalita;
    public $tglLahirBalita;
    public $JKBalita;
    public $umurBalita;
    public $beratBalita;
    public $panjangBalita;
    public $lingkarKepalaBalita;
    public $asiEkslusif;
    public $imunisasi;

    public $bayi=[];
    public $selectedIbuID;

    protected $listeners = [
        'getBayiByIbu' => 'getBayiByIbu',
    ];

    public function hydrate()
    {
        $this->dispatchBrowserEvent('loadSelect2');
    }

    public function render()
    {
        $ibu = Peserta::where('jenisKelamin', 'P')->whereYear('tanggalLahir', '<', '2010')->get();

        $imunisasis = Imunisasi::all();
        
        if($this->nama > 0 ){
            $ibuperiksa= Peserta::where('pesertaID',$this->nama)->first();
            $this->NIK = $ibuperiksa->NIK;
            $this->tglLahir = $ibuperiksa->tanggalLahir;

        }else if($this->nama == 0){
            $this->nik = '';
            $this->tglLahir = '';
        }

        return view('livewire.balita-index',[
            'ibu' => $ibu, 
            'imunisasis' => $imunisasis,
            'bayi' => $this->bayi,
        ]);
    }

    public function getBayiByIbu()
    {
        // $this->bayi = BayiPeriksa::select('pesertaID')
        //     ->where('ibuID',$this->nama)
        //     ->get();
            
    }

    public function store()
    {

        $calonIbu = Peserta::where('pesertaID', $this->nama)->first(); 
        if(!$calonIbu){
            $this->validate([
                'nama' => ['required'],
                'NIK' => ['required'],
                'tglLahir' => ['required']
            ]);

            $peserta = Peserta::create([
                'nama' => $this->nama, 
                'NIK' => $this->NIK,
                'jenisKelamin' => 'P',
                'tanggalLahir' => $this->tglLahir,
                'userID' => Auth::user()->id,
            ]);

            $this->idIbu =  $peserta->pesertaID;

            $this->peserta =Peserta::where('jenisKelamin', 'P')->get();
        }else{
            $this->validate([
                'nama' => ['required'],
                'NIK' => ['required'],
                'tglLahir' => ['required']
            ]);
            $this->idIbu =  $calonIbu->pesertaID;
            $calonIbu->NIK = $this->NIK;
            $calonIbu->tanggalLahir = $this->tglLahir;

            $calonIbu->save();
        }

        $balita = Peserta::create([
            'nama' => $this->balita, 
            'NIK' => $this->NIKBalita,
            'jenisKelamin' => $this->JKBalita,
            'tanggalLahir' => $this->tglLahirBalita,
            'userID' => Auth::user()->id,
        ]);


        $bayiPeriksa = BayiPeriksa::create([
            'ibuID' => $this->idIbu,
            'posyanduID' => Auth::user()->posyanduID,
            'pesertaID' => $balita->pesertaID,
            'umur' => $this->umurBalita,
            'beratBadan' => $this->beratBalita,
            'panjangBadan' => $this->panjangBalita,
            'lingkarKepala' => $this->lingkarKepalaBalita,
            'asiEkslusif' => $this->asiEkslusif,
            'imunisasiID' => $this->imunisasi,
            'userID' => Auth::user()->id,
            'tanggal' => Carbon::now(),
        ]);


        $this->dispatchBrowserEvent('swal:modalSuccess');

        $this->resetForm();
    }

    private function resetForm(){
        $this->idIbu = '';
        $this->nama= 'defaul';
        $this->NIK= '';
        $this->tglLahir= '';
        $this->balita= '';
        $this->NIKBalita= '';
        $this->tglLahirBalita= '';
        $this->JKBalita= '';
        $this->umurBalita= '';
        $this->beratBalita= '';
        $this->panjangBalita= '';
        $this->lingkarKepalaBalita= '';
        $this->aksiEkslusif= '';
        $this->imunisasi= '';
    }
}
