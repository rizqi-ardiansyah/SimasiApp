<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BencanaController;
use App\Http\Controllers\PoskoController;
use App\Http\Controllers\MemberTeamController;
use App\Http\Controllers\PengungsiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\CadangController;
use App\Http\Controllers\RansumController;
use App\Http\Controllers\KepulanganController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\KondisiRumahController;


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
// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Saat memakai localhost:8080
Route::get('/simasi/public/login', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/simasi/public/logout', [LoginController::class, 'logout']);

Route::resource('dashboard', DashboardController::class)->middleware('auth');
Route::resource('bencana', BencanaController::class);
Route::resource('posko', PoskoController::class);
Route::resource('member', MemberController::class);
Route::resource('kepulangan', KepulanganController::class);
Route::resource('memberTeam', MemberTeamController::class);
Route::resource('pengungsi', PengungsiController::class);
Route::resource('cadang', CadangController::class)->only(['index', 'store', 'destroy']);
Route::resource('laporan', LaporanController::class)->only(['index', 'store', 'destroy']);

Route::get('/memberPusdalop', [MemberController::class, 'memberPusdalop']);
Route::get('/memberPusdalop/member', [MemberTeamController::class, 'memberPusdalop']);
Route::post('/memberPusdalop/create', [MemberTeamController::class, 'createMember'])->name('memberTeam.create');
Route::match(['get', 'post'], 'memberPusdalop/edit/{id}', [MemberTeamController::class, 'edit']);
Route::post('memberPusdalop/deleteAnggota/{id}', [MemberTeamController::class, 'deleteAnggota']);

Route::get('/memberTRC', [MemberController::class, 'memberTRC']);
Route::post('/memberTRC/create', [MemberTeamController::class, 'createMember'])->name('memberTeam.create');
Route::match(['get', 'post'], 'memberTRC/edit/{id}', [MemberTeamController::class, 'edit']);
Route::post('memberTRC/deleteAnggota/{id}', [MemberTeamController::class, 'deleteAnggota']);

Route::get('/pengungsi/keluarga', 'App\Http\Controllers\PengungsiController@showKeluarga');

Route::resource('member', MemberController::class);
Route::post('member/create', [MemberController::class, 'createMember'])->name('member.create');
Route::match(['get', 'post'], 'member/edit/{id}', [MemberController::class, 'edit']);
Route::post('member/delete/{id}', [MemberController::class, 'delete']);

Route::post('bencana/create', [BencanaController::class, 'createBencana'])->name('bencana.create');
Route::match(['get', 'post'], 'bencana/edit/{id}', [BencanaController::class, 'edit']);
Route::post('bencana/delete/{id}', [BencanaController::class, 'delete']);

Route::post('posko/create', [PoskoController::class, 'createPosko'])->name('posko.create');
Route::match(['get', 'post'], 'posko/edit/{id}', [PoskoController::class, 'edit']);
Route::post('posko/delete/{id}', [PoskoController::class, 'delete']);
Route::get('/listPosko/{id}', [PoskoController::class, 'index']);

Route::post('rumahRusak/create', [KepulanganController::class, 'createRumah'])->name('rumahRusak.create');
Route::get('/rumahRusak/{id}/{bencana_id}/{trc_id}', [KepulanganController::class, 'rumahRusak']);
Route::match(['get', 'post'], 'rumahRusak/edit/{id}', [KepulanganController::class, 'editRumahRusak']);
Route::post('rumahRusak/delete/{id}', [KepulanganController::class, 'delete']);
Route::get('/poskoKepulangan/{id}', [KepulanganController::class, 'poskoKepulangan']);

Route::get('/kondisiSekitar/{bencana_id}', [KepulanganController::class, 'kondisiSekitar']);
Route::post('kondisiSekitar/create', [KepulanganController::class, 'createKondisi'])->name('kondisiSekitar.create');
Route::match(['get', 'post'], 'kondisiSekitar/edit/{id}', [KepulanganController::class, 'editKondisiSekitar']);
Route::post('kondisiSekitar/delete/{id}', [KepulanganController::class, 'deleteKondisiSekitar']);

Route::get('/listPengungsi/{id}/{bencana_id}/{trc_id}', [PengungsiController::class, 'index']);
Route::post('pengungsi/create', [PengungsiController::class, 'createPengungsi'])->name('pengungsi.create');
Route::match(['get', 'post'], 'pengungsi/edit/{id}', [PengungsiController::class, 'edit']);
Route::post('pengungsi/delete/{id}', [PengungsiController::class, 'delete']);
// Route::get('listPengungsi/{idPosko}/{idBencana}/{idTrc}', [PengungsiController::class, 'store']);

Route::get('/ransum/{id}/{bencana_id}/{trc_id}', [RansumController::class, 'index']);

Route::get("/search/bencana", [BencanaController::class, 'search'])->name('searchBencana');
Route::get("/search/bencanaTrc/{id}", [BencanaController::class, 'searchForTrc'])->name('searchForTrc');
Route::get("/search/member", [MemberController::class, 'search'])->name('searchAdmin');
Route::get("/search/posko", [PoskoController::class, 'search'])->name('searchPosko');
Route::get("/search/poskoTrc/{id}", [PoskoController::class, 'searchPoskoTrc']);
Route::get("/search/pengungsi", [PengungsiController::class, 'search'])->name('searchPengungsi');
Route::get("/search/pengungsi/masuk", [PengungsiController::class, 'searchPengMasuk'])->name('searchPengMasuk');
Route::get("/search/pengungsi/keluar", [PengungsiController::class, 'searchPengKeluar'])->name('searchPengKeluar');

Route::post('cadang/create', [CadangController::class, 'create'])->name('cadang.create');
// Route::post('cadang/destroy/{file_name}', [CadangController::class, 'destroy'])->name('cadang.destroy');
Route::post('cadang/destroy/{file_name}', [CadangController::class, 'destroy'])->name('cadang.destroy');
Route::get('cadang/{file_name}',  [CadangController::class, 'download'])->name('cadang.download');
Route::post('cadang/delete/{id}', [CadangController::class, 'delete']);
Route::post('bencana/create', [BencanaController::class, 'createBencana'])->name('bencana.create');
Route::get('cadang/import', [CadangController::class, 'import'])->name('cadang.import');
// Route::post('cadang/store', [CadangController::class, 'store'])->name('cadang.store');
Route::post('pengungsi/store', [PengungsiController::class, 'store'])->name('pengungsi.store');

// Route::get('laporan/exportPdf/{id}',  [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');
Route::get('laporan/exportPdf/{id}', [LaporanController::class, 'exportPdf']);
Route::get('laporan/exportExcel/{id}', [LaporanController::class, 'exportExcel']);

Route::get("/search/bencana", [BencanaController::class, 'searchBencana'])->name('bencana.searchBencana');
Route::get("/search/posko", [PoskoController::class, 'searchPosko'])->name('posko.searchPosko');
Route::get("/searc/listPengungsi", [PengungsiController::class, 'searchPengungsi'])->name('searchPengungsi');
Route::get("/search/memberPusdalop", [MemberController::class, 'searchPusdalop'])->name('searchPusdalop');
Route::get("/search/memberTRC", [MemberController::class, 'searchTRC'])->name('searchTRC');
// Route::get('bencana/cari',[BencanaController::class, 'search'])->name('searchBencana');

Route::get('/carinama', [KepulanganController::class, 'getData'])->name('dropdown.data');
// Route::get('selectName', [IndonesiaController::class, 'provinsi'])->name('provinsi.index');



// Route::post('cadang/delete/{id}', [CadangController::class, 'destroy']);
