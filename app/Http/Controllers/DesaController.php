<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function getDesa(){
        $desa = Desa::getDesa();
    }
}
