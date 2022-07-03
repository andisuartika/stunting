<?php

namespace App\Http\Livewire;

use App\Models\Peserta;
use App\Models\Posyandu;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CalonIbuIndex extends Component
{
    use WithFileUploads;

    public $idPeserta;
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
    public int $highlightIndex = 0;
    public bool $showDropdown;
    public bool $showDataPeserta;
    public bool $isLoading = false;

    protected $listeners = [
        'selectPerserta' => 'selectPerserta',
    ];

    public function render()
    {   
        // GET DATA POSYANDU PETUGAS
        $user = Auth::user()->posyanduID;
        $decode = json_decode($user);
        $posyandu = Posyandu::whereIn('posyanduID', $decode)->get();
        
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
        $this->pesertas = Peserta::where('jenisKelamin', 'P')->where('nama', 'like', '%' . $this->query. '%')->orWhere('NIK','like', '%' . $this->query. '%')
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
        }else{
            $this->nik = '';
            $this->tglLahir = '';
        }
        
        $this->showDropdown = false;
        $this->showDataPeserta = true;
    
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->accounts) - 1) {
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->accounts) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    public function submitPeserta()
    {
        $this->validate([
            'nama' => ['required'],
            'nik' => ['required'],
            'tglLahir' => ['required'],
        ]);

        // $this->isLoading = true;

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
        // $this->isLoading = false;
        $this->dispatchBrowserEvent('swal:modalSuccess');

    }

    public function store()
    {   
        dd($this->periode);
        $calonIbu = Peserta::where('pesertaID', $this->idPeserta)->first(); 


        // $ibuPeriksa = IbuPeriksa::create([
        //     'pesertaID' => $this->idPeserta,
        //     'umur' => $this->umur,
        //     'lingkarPinggang' => $this->lingkarPinggang,
        //     'lingkarBokong' => $this->lingkarBokong,
        //     'lingkarLengan' => $this->lingkarLengan,
        //     'tinggiBadan' => $this->tinggiBadan,
        //     'beratBadan' => $this->beratBadan,
        // ]);


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
