<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class CalonIbuController extends Controller
{
    public function index()
    {
        return view('pages.calon-ibu');
    }

    public function action(Request $request)
    {
        $data = $request->all();
        $query = $data['query'];

        $filter_data = Peserta::where('jenisKelamin', 'P')->where('nama','LIKE','%'.$query.'%')->get();

        return response()->json($filter_data);
    }
}
