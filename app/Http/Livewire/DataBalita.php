<?php

namespace App\Http\Livewire;

use App\Models\Balita;
use Livewire\Component;

class DataBalita extends Component
{
    public function render()
    {
        $dataBalita = Balita::whereYear('tanggalLahir','>',2010)
                        ->get();

        return view('livewire.data-balita', ['dataBalita' => $dataBalita]);
    }
}
