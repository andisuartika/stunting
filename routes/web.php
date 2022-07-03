<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\CalonIbuController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getDesa',[DesaController::class, 'getDesa'] );
Route::get('/getKecamatan',[KecamatanController::class, 'getKecamatan'] );
Route::get('/getKabupaten',[KabupatenController::class, 'getKabupaten'] );

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::get('/ibu', [CalonIbuController::class, 'index'])->name('calon-ibu');

    Route::get('/balita', function(){
        return view('pages.balita');
    })->name('balita');
});

Route::get('test', function() {
    Storage::disk('google')->put('stunting.txt', 'Hello World');
});
