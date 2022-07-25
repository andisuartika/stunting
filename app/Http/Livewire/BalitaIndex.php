<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Peserta;
use Livewire\Component;
use App\Models\Posyandu;
use App\Models\Imunisasi;
use App\Models\BayiPeriksa;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BalitaIndex extends Component
{
    use WithFileUploads;

    public $idIbu;
    public $namaIbu;
    public $NIKIbu;
    public $tglLahirIbu;
    public $idBalita;
    public $namaBalita;
    public $NIKBalita;
    public $tglLahirBalita;
    public $JKBalita;
    public $file;
    public $urlFile;

    public $idPeriksa;
    public $periode;
    public $posyandu;
    public $umurBalita;
    public $beratBalita;
    public $panjangBalita;
    public $lingkarKepalaBalita;
    public $lingkarLenganBalita;
    public $asiEkslusif;
    public $imunisasi=[];

    public array $bayis=[];
    public array $ibus=[];
    public $selectedBayi;
    public $selectedIbu;
    public $bayi;
    public $query= '';
    public $queryIbu= '';
    public bool $showDropdown;
    public bool $showDataBayi = false;
    public bool $dataBaru = false;


     // ERROR MESS
     protected $messages = [
        'namaBalita.required' => 'Nama balita tidak boleh kosong.',
        'queryIbu.required' => 'Ibu balita tidak boleh kosong.',
        'nik.min' => 'NIK harus 16 karakter.',
        'tglLahirBalita.required' => 'Tanggal Lahir tidak boleh kosong.',
        'JKBalita.required' => 'Pilih jenis kelamin balita.',
        'posyandu.required' => 'Silahkan pilih posyandu.',
        'imunisasi.required' => 'Silahkan pilih jenis Imunisasi.',
        'umurBalita.required' => 'Umur tidak boleh kosong',
        'beratBalita.required' => 'Berat badan tidak boleh kosong',
        'panjangBalita.required' => 'Panjang badan tidak boleh kosong',
        'lingkarPinggang.required' => 'Lingkar pinggang tidak boleh kosong',
        'lingkarLengan.required' => 'Lingkar lengan tidak boleh kosong',
        'lingkarKepalaBalita.required' => 'Lingkar Kepala tidak boleh kosong',
    ];

    public function render()
    {
        // GET DATA POSYANDU PETUGAS
        $user = Auth::user()->posyanduID;
        $decode = json_decode($user);
        $posyandu = Posyandu::whereIn('posyanduID', $decode)->get();

        $imunisasis = Imunisasi::all();

        // GET DATA PERIKSA PERIODE
        if($this->bayi)
        {
            $year = Carbon::now()->year; 
            $periksa = BayiPeriksa::where('pesertaID',$this->idBalita)->whereYear('created_at',$year)->where('periode',(int)$this->periode)->first();

            if($periksa)
            {

                $this->idPeriksa = $periksa->periksaID;
                $this->umurBalita = $periksa->umur;
                $this->beratBalita = $periksa->beratBadan;
                $this->panjangBalita = $periksa->panjangBadan;
                $this->lingkarKepalaBalita= $periksa->lingkarKepala;
                $this->lingkarLenganBalita= $periksa->lingkarLengan;
                $this->asiEkslusif = $periksa->asiEkslusif;
                $this->imunisasi = $periksa->imunisasiID;
            }else{
                $this->idPeriksa = '';
                $this->umurBalita = Carbon::parse($this->bayi->tanggalLahir)->diff(Carbon::now())->m;
                $this->beratBalita = '';
                $this->panjangBalita = '';
                $this->lingkarKepalaBalita= '';
                $this->lingkarLenganBalita= '';
                $this->asiEkslusif = '';
                $this->imunisasi = [];
            }
        }
        
        return view('livewire.balita-index',[
            'posyandus' => $posyandu,
            'imunisasis' => $imunisasis,
        ]);
    }

    public function reset(...$properties)
    {
        $this->query = '';
        $this->queryIbu = '';
        $this->showDropdown = true;
    }

    public function updatedQuery()
    {
        $this->bayis = Peserta::whereYear('tanggalLahir','>',2010)->where('nama', 'like', '%' . $this->query. '%')->orWhere('NIK','like', '%' . $this->query. '%')
            ->take(5)
            ->get()
            ->toArray();
            
    }

    public function updatedQueryIbu()
    {

        $this->ibus = Peserta::whereYear('tanggalLahir','<',2010)->where('nama', 'like', '%' . $this->queryIbu. '%')->orWhere('NIK','like', '%' . $this->queryIbu. '%')
        ->take(5)
        ->get()
        ->toArray();
    }

    public function selectBayi($bayiID)
    {
        
        $this->bayi= Peserta::where('pesertaID',$bayiID)->first();
        $ibu = Peserta::where('pesertaID',$this->bayi->ibuID)->first();
        if($this->bayi){

            $this->NIKBalita = $this->bayi->NIK;
            $this->namaBalita = $this->bayi->nama;
            $this->tglLahirBalita = $this->bayi->tanggalLahir;
            $this->idBalita = $this->bayi->pesertaID;
            $this->JKBalita = $this->bayi->jenisKelamin;           
            $this->query = '';
            $this->urlFile = $this->bayi->fileBukti;

            $this->namaIbu = $ibu->nama;
            $this->NIKIbu = $ibu->NIK;
            $this->tglLahirIbu = $ibu->tanggalLahir;
        }else{
            $this->nik = '';
            $this->tglLahir = '';
            $this->urlFile = '';
        }
        
        $this->showDropdown = false;
        $this->showDataBayi = true;
        $this->dataBaru = false;
    
    }

    public function selectIbu($ibuID)
    {
        $ibu = Peserta::where('pesertaID',$ibuID)->first();
        $this->idIbu = $ibu->pesertaID;
        $this->namaIbu = $ibu->nama;
        $this->queryIbu = $ibu->nama;
        $this->NIKIbu = $ibu->NIK;
        $this->tglLahirIbu = $ibu->tanggalLahir;

        $this->showDropdown = false;
        $this->showDataBayi = true;
    }

    public function submitBayi()
    {
        
        $this->validate([
            'namaBalita' => ['required'],
            'namaBalita' => ['required'],
            'NIKBalita' => ['min:16'],
            'tglLahirBalita' => ['required'],
            'JKBalita' => ['required'],
        ]);


        $bayi = Peserta::where('pesertaID', $this->idBalita)->first(); 
        if($bayi){
            // UPDATE DATA
            $bayi->nama = $this->namaBalita;
            $bayi->NIK = $this->NIKBalita;
            $bayi->tanggalLahir = $this->tglLahirBalita;
            $bayi->jenisKelamin = $this->JKBalita;

            // UPLOAD FILE
            $filename = 'KIA-'.$this->NIKBalita;
            if(!empty($this->file)){
                // UPLOAD FILE TO GOOGLE DRIVE
                $res = Storage::disk('google')->putFileAs('1cQ5apmBYDenaIIidcwW3nCLrNLWNrhyp', $this->file, $filename);
                
                // GET URL FILE
                $url = Storage::disk('google')->url($res);
                $bayi->fileBukti = $url;
            }

            $bayi->save();
            $this->selectBayi($bayi->pesertaID);
        }else{
            // CREATE BALITA BARU
            $this->validate([
                'queryIbu' => ['required'],
            ]);
            
            $fileBukti = '';
            $filename = 'KIA-'.$this->NIKBalita;
            if(!empty($this->file)){
                // UPLOAD FILE TO GOOGLE DRIVE
                $res = Storage::disk('google')->putFileAs('1cQ5apmBYDenaIIidcwW3nCLrNLWNrhyp', $this->file, $filename);
                
                // GET URL FILE
                $url = Storage::disk('google')->url($res);
                $fileBukti = $url;
            }

            if($this->NIKBalita){
                $this->NIKBalita = $this->NIKBalita;
            }else{
                $this->NIKBalita= NULL;
            }

            $peserta = Peserta::create([
                'nama' => $this->namaBalita, 
                'NIK' => $this->NIKBalita,
                'jenisKelamin' => $this->JKBalita,
                'tanggalLahir' => $this->tglLahirBalita,
                'userID' => Auth::user()->id,
                'ibuID' => $this->idIbu,
                'fileBukti' => $fileBukti,
            ]);

            $this->selectBayi($peserta->pesertaID);
        }
        $this->dispatchBrowserEvent('swal:modalSuccess');

    }

    public function store()
    {

        $this->validate([
            'posyandu' => ['required'],
            'periode' => ['required'],
            'umurBalita' => ['required','numeric'],
            'beratBalita' => ['required','numeric'],
            'panjangBalita' => ['required','numeric'],
            'lingkarKepalaBalita' => ['required'],
            'lingkarLenganBalita' => ['required'],
            'imunisasi' => ['required'],
        ]); 

        
        if($this->idPeriksa){
            // UPDATE DATA
            $balita = BayiPeriksa::where('periksaID', $this->idPeriksa)->first(); 

            $balita->posyanduID = $this->posyandu;
            $balita->umur = $this->umurBalita;
            $balita->beratBadan = $this->beratBalita;
            $balita->panjangBadan = $this->panjangBalita;
            $balita->lingkarKepala = $this->lingkarKepalaBalita;
            $balita->lingkarLengan = $this->lingkarLenganBalita;
            $balita->asiEkslusif = $this->asiEkslusif;
            $balita->imunisasiID = array_map('intval', $this->imunisasi);
            $balita->userID = Auth::user()->id;

            $balita->save();

        }else{
            // CREATE
            $bayiPeriksa = BayiPeriksa::create([
                'posyanduID' => $this->posyandu,
                'pesertaID' => $this->idBalita,
                'periode' => $this->periode,
                'umur' => $this->umurBalita,
                'beratBadan' => $this->beratBalita,
                'panjangBadan' => $this->panjangBalita,
                'lingkarKepala' => $this->lingkarKepalaBalita,
                'lingkarLengan' => $this->lingkarLenganBalita,
                'asiEkslusif' => $this->asiEkslusif,
                'imunisasiID' => array_map('intval', $this->imunisasi),
                'userID' => Auth::user()->id,
                'tanggal' => Carbon::now(),
            ]);

            $this->periode = $bayiPeriksa->periode;
        }  


        $this->dispatchBrowserEvent('swal:modalSuccess');

    }
    
    public function addData()
    {
        $this->dataBaru = true;
        $this->showDataBayi = true;
        $this->resetForm();
    }

    public function resetForm(){
        $this->idBalita= '';
        $this->idIbu= '';
        $this->namaIbu= '';
        $this->namaBalita= '';
        $this->NIKBalita= '';
        $this->NIKIbu= '';
        $this->tglLahirBalita= '';
        $this->tglLahirIbu= '';
        $this->JKBalita= '';
        $this->queryIbu='';
        $this->urlFile='';
        $this->periode='';
        $this->posyandu='';
    }
}
