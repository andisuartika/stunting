<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function getKabupaten(){
        $kabupaten = Kabupaten::getKabupaten();
    }
}
