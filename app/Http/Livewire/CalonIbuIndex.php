<?php

namespace App\Http\Livewire;

use App\Models\IbuPeriksa;
use App\Models\Peserta;
use App\Models\Posyandu;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CalonIbuIndex extends Component
{
    use WithFileUploads;

    public $idPeserta;
    public $idPeriksa;
    public $nama;
    public $nik;
    public $tglLahir;
    public $umur;
    public $beratBadan;
    public $tinggiBadan;
    public $lingkarPinggang;
    public $lingkarBokong;
    public $lingkarLengan;
    public $urlFile;
    public $file;
    public $posyanduID;
    public $periode;

    public array $pesertas = [];
    public $peserta;
    public $query= '';
    public int $selectedPeserta = 0;
    public bool $showDropdown;
    public bool $showDataPeserta;
    public bool $isLoading = false;

    protected $listeners = [
        'selectPerserta' => 'selectPerserta',
    ];


    // ERROR MESS
    protected $messages = [
        'nama.required' => 'Nama calon ibu tidak boleh kosong.',
        'nik.required' => 'NIK tidak boleh kosong.',
        'nik.min' => 'NIK harus 16 karakter.',
        'tglLahir.required' => 'Tanggal Lahir tidak boleh kosong.',
        'file.required' => 'Silahkan upload kartu keluarga.',
        'posyanduID.required' => 'Silahkan pilih posyandu.',
        'umur.required' => 'Umur tidak boleh kosong',
        'beratBadan.required' => 'Berat badan tidak boleh kosong',
        'tinggiBadan.required' => 'Tinggi badan tidak boleh kosong',
        'lingkarPinggang.required' => 'Lingkar pinggang tidak boleh kosong',
        'lingkarBokong.required' => 'Lingkar bokong tidak boleh kosong',
        'lingkarLengan.required' => 'Lingkar lengan tidak boleh kosong',
    ];

    public function render()
    {   
        // GET DATA POSYANDU PETUGAS
        $user = Auth::user()->posyanduID;
        $decode = json_decode($user);
        $posyandu = Posyandu::whereIn('posyanduID', $decode)->get();

        // GET DATA PERIKSA PERIODE
        if($this->peserta)
        {
            $year = Carbon::now()->year; 
            $periksa = IbuPeriksa::where('pesertaID',$this->idPeserta)->whereYear('created_at',$year)->where('periode',(int)$this->periode)->first();
            if($periksa)
            {
                $this->idPeriksa = $periksa->periksaID;
                $this->umur = $periksa->umur;
                $this->lingkarPinggang = $periksa->lingkarPinggang;
                $this->lingkarBokong = $periksa->lingkarBokong;
                $this->lingkarLengan = $periksa->lingkarLengan;
                $this->tinggiBadan = $periksa->tinggiBadan;
                $this->beratBadan = $periksa->beratBadan;
            }else{
                $this->idPeriksa = '';
                $this->umur = '';
                $this->lingkarPinggang = '';
                $this->lingkarBokong = '';
                $this->lingkarLengan = '';
                $this->tinggiBadan = '';
                $this->beratBadan = '';
            }
        }
        
        return view('livewire.calon-ibu-index',['posyandu' => $posyandu]);
    }

    public function reset(...$properties)
    {
        $this->query = '';
        $this->showDropdown = true;
    }

    public function hideDataPeserta()
    {
        $this->showDataPeserta = false;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function updatedQuery()
    {
        $this->pesertas = Peserta::whereYear('tanggalLahir','<',2010)->where('jenisKelamin', 'P')->where('nama', 'like', '%' . $this->query. '%')->orWhere('NIK','like', '%' . $this->query. '%')
            ->take(5)
            ->get()
            ->toArray();
    }

    public function selectPeserta($pesertaID)
    {
        
        $this->peserta= Peserta::where('pesertaID',$pesertaID)->first();

        if($this->peserta){
            $this->nik = $this->peserta->NIK;
            $this->nama = $this->peserta->nama;
            $this->tglLahir = $this->peserta->tanggalLahir;
            $this->idPeserta = $this->peserta->pesertaID;
            $this->query = '';
            $this->urlFile = $this->peserta->fileBukti;
            $this->selectedPeserta = $this->peserta->pesertaID;
        }else{
            $this->nik = '';
            $this->tglLahir = '';
        }
        
        $this->showDropdown = false;
        $this->showDataPeserta = true;
    
    }


    public function submitPeserta()
    {
        
        $this->validate([
            'nama' => ['required'],
            'nik' => ['required','min:16'],
            'tglLahir' => ['required'],
        ]);


        $calonIbu = Peserta::where('pesertaID', $this->idPeserta)->first(); 
        if($calonIbu){
            // UPDATE DATA
            $calonIbu->nama = $this->nama;
            $calonIbu->NIK = $this->nik;
            $calonIbu->tanggalLahir = $this->tglLahir;

            // UPLOAD FILE
            $filename = 'KK-'.$this->nik;
            if(!empty($this->file)){
                // UPLOAD FILE TO GOOGLE DRIVE
                $res = Storage::disk('google')->putFileAs('1OQUVzQ1zLuPnYQPi7i1joE0x55mdT36H', $this->file, $filename);
                
                // GET URL FILE
                $url = Storage::disk('google')->url($res);
                $calonIbu->fileBukti = $url;
            }

            $calonIbu->save();
            $this->selectPeserta($calonIbu->pesertaID);
        }else{
            // CREATE PESERTA BARU
            $this->validate([
                'file' => ['required','image'],
            ]);
            
            $fileBukti = '';
            $filename = 'KK-'.$this->nik;
            if(!empty($this->file)){
                // UPLOAD FILE TO GOOGLE DRIVE
                $res = Storage::disk('google')->putFileAs('1OQUVzQ1zLuPnYQPi7i1joE0x55mdT36H', $this->file, $filename);
                
                // GET URL FILE
                $url = Storage::disk('google')->url($res);
                $fileBukti = $url;
            }

            $peserta = Peserta::create([
                'nama' => $this->nama, 
                'NIK' => $this->nik,
                'jenisKelamin' => 'P',
                'tanggalLahir' => $this->tglLahir,
                'userID' => Auth::user()->id,
                'fileBukti' => $fileBukti,
            ]);

            $this->selectPeserta($peserta->pesertaID);
        }
        $this->dispatchBrowserEvent('swal:modalSuccess');

    }

    public function store()
    {   
        $this->validate([
            'posyanduID' => ['required'],
            'periode' => ['required'],
            'umur' => ['required','numeric'],
            'lingkarPinggang' => ['required','numeric'],
            'lingkarBokong' => ['required','numeric'],
            'lingkarLengan' => ['required','numeric'],
            'tinggiBadan' => ['required','numeric'],
            'beratBadan' => ['required','numeric'],
        ]); 

        
        if($this->idPeriksa)
        {
            // UPDATE
            $ibuPeriksa = IbuPeriksa::where('periksaID',$this->idPeriksa)->first();
            
            $ibuPeriksa->posyanduID = $this->posyanduID;
            $ibuPeriksa->periode = $this->periode;
            $ibuPeriksa->umur = $this->umur;
            $ibuPeriksa->lingkarPinggang = $this->lingkarPinggang;
            $ibuPeriksa->lingkarBokong = $this->lingkarBokong;
            $ibuPeriksa->lingkarLengan = $this->lingkarLengan;
            $ibuPeriksa->tinggiBadan = $this->tinggiBadan;
            $ibuPeriksa->beratBadan = $this->beratBadan;
            $ibuPeriksa->userID = Auth::user()->id;

            $ibuPeriksa->save();

        }
        else
        {
            // CREATE
            $ibuPeriksa =  IbuPeriksa::create([
                'posyanduID' => $this->posyanduID,
                'pesertaID' => $this->idPeserta,
                'periode' => $this->periode,
                'umur' => $this->umur,
                'lingkarPinggang' => $this->lingkarPinggang,
                'lingkarBokong' => $this->lingkarBokong,
                'lingkarLengan' => $this->lingkarLengan,
                'tinggiBadan' => $this->tinggiBadan,
                'beratBadan' => $this->beratBadan,
                'userID' => Auth::user()->id,
            ]);

            $this->periode = $ibuPeriksa->periode;
        }

        $this->dispatchBrowserEvent('swal:modalSuccess');

        // $this->resetForm();
    }

    public function resetForm()
    {
        $this->showDataPeserta = true;
        // RESET FORM
        $this->idPeserta= '';
        $this->nama= '';
        $this->nik= '';
        $this->tglLahir= '';
        $this->file='';
        $this->urlFile='';
    }


}
