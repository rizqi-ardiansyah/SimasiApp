<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BencanaController;
use App\Http\Controllers\PoskoController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PengungsiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\CadangController;


use App\Http\Controllers\LoginController;

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


Route::get('', function () {
    return view('login.login', [
        'title' => 'Silahkan login terlebih dahulu'
    ]);
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout']);

Route::resource('dashboard', DashboardController::class)->middleware('auth');
Route::resource('bencana', BencanaController::class);
Route::resource('posko', PoskoController::class);
Route::resource('member', MemberController::class);
Route::resource('pengungsi', PengungsiController::class);
Route::resource('cadang', CadangController::class)->only(['index', 'store', 'destroy']);
Route::resource('laporan', LaporanController::class)->only(['index', 'store', 'destroy']);

Route::get('/pengungsi/keluarga', 'App\Http\Controllers\PengungsiController@showKeluarga');

Route::post('member/create', [MemberController::class, 'createMember'])->name('member.create');
Route::match(['get', 'post'], 'member/edit/{id}', [MemberController::class, 'edit']);
Route::post('member/delete/{id}', [MemberController::class, 'delete']);

Route::post('bencana/create', [BencanaController::class, 'createBencana'])->name('bencana.create');
Route::match(['get', 'post'], 'bencana/edit/{id}', [BencanaController::class, 'edit']);
Route::post('bencana/delete/{id}', [BencanaController::class, 'delete']);

Route::post('posko/create', [PoskoController::class, 'createPosko'])->name('posko.create');
Route::match(['get', 'post'], 'posko/edit/{id}', [PoskoController::class, 'edit']);
Route::post('posko/{id}', [PoskoController::class, 'delete']);
Route::get('/listPosko/{id}', [PoskoController::class, 'index']);

Route::get('/listPengungsi/{id}', [PengungsiController::class, 'index']);
Route::post('pengungsi/create', [PengungsiController::class, 'createPengungsi'])->name('pengungsi.create');
Route::match(['get', 'post'], 'pengungsi/edit/{id}', [PengungsiController::class, 'edit']);
Route::post('pengungsi/delete/{id}', [PengungsiController::class, 'delete']);

Route::get("/search/bencana", [BencanaController::class, 'search'])->name('searchBencana');
Route::get("/search/bencanaTrc/{id}", [BencanaController::class, 'searchForTrc'])->name('searchForTrc');
Route::get("/search/member", [MemberController::class, 'search'])->name('searchAdmin');
Route::get("/search/posko", [PoskoController::class, 'search'])->name('searchPosko');
Route::get("/search/poskoTrc/{id}", [PoskoController::class, 'searchPoskoTrc']);
Route::get("/search/pengungsi", [PengungsiController::class, 'search'])->name('searchPengungsi');
Route::get("/search/pengungsi/masuk", [PengungsiController::class, 'searchPengMasuk'])->name('searchPengMasuk');
Route::get("/search/pengungsi/keluar", [PengungsiController::class, 'searchPengKeluar'])->name('searchPengKeluar');

Route::post('cadang/create', [CadangController::class, 'create'])->name('cadang.create');
Route::get('cadang/{file_name}',  [CadangController::class, 'download'])->name('cadang.download');


// Route::get('laporan/exportPdf/{id}',  [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');
Route::get('laporan/exportPdf/{id}', [LaporanController::class, 'exportPdf']);
Route::get('laporan/exportExcel/{id}', [LaporanController::class, 'exportExcel']);

// Route::post('cadang/delete/{id}', [CadangController::class, 'destroy']);
