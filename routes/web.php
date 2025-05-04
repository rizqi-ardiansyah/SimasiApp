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
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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
// Route::prefix('admin')->name('admin.')->group(function () { 
//     Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');     
//     Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit'); 
//     Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
// });

// Route::get('/login', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login'); 
// Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

// Route::middleware('auth:admin')->get('/admin/dashboard', function () { return 'Selamat datang Admin!'; });

// Route::middleware('auth:karyawan')->get('/karyawan/dashboard', function () { return 'Selamat datang Karyawan!'; });


Route::get('', function () {
    return view('login.login', [
        'title' => 'Silahkan login terlebih dahulu'
    ]);
});


// Halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Proses login
// Route::post('/login', [LoginController::class, 'authenticate']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard - hanya bisa diakses setelah login
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });

// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Saat memakai localhost:8080
// Route::get('/simasi/public/login', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/simasi/public/logout', [LoginController::class, 'logout']);

// Route::resource('karyawan', DashboardController::class)->middleware('auth');
Route::get('/karyawan', function () {
    return view('admin.karyawan.index');
});

// Route::resource('dashboard', DashboardController::class)->middleware('auth');
Route::middleware(['auth:web,karyawan,admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
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

// Route::resource('member', MemberController::class);
Route::post('memberPusdalop/create', [MemberController::class, 'createMemberPusdalop'])->name('memberPusdalop.create');
Route::match(['get', 'post'], 'member/editPusdalop/{id}', [MemberController::class, 'editPusdalop']);
Route::post('member/delete/{id}', [MemberController::class, 'delete']);

Route::post('memberTrc/create', [MemberController::class, 'createMemberTrc'])->name('memberTrc.create');
Route::match(['get', 'post'], 'member/editTrc/{id}', [MemberController::class, 'editTrc']);

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

Route::post('kondisiPsikologis/create', [PengungsiController::class, 'createPsikologis'])->name('kondisiPsikologis.create');

Route::get('/ransum/{id}/{bencana_id}/{trc_id}', [RansumController::class, 'index']);

Route::get('/kepulangan/{id}/{bencana_id}/{trc_id}', [PengungsiController::class, 'kepulangan']);
Route::match(['get', 'post'], 'kepulangan/edit/{id}', [PengungsiController::class, 'editKonfis']);
Route::match(['get', 'post'], 'editKonRum/edit/{id}', [PengungsiController::class, 'updateKonRum']);
Route::match(['get', 'post'], 'editSekKonRum/edit/{id}', [PengungsiController::class, 'updateSekKonRum']);

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
Route::get("/searc/listPengungsi", [PengungsiController::class, 'searchPengungsis'])->name('pengungsi.searchPengungsis');
Route::get("/search/memberPusdalop", [MemberController::class, 'searchPusdalop'])->name('searchPusdalop');
Route::get("/search/memberTRC", [MemberController::class, 'searchTRC'])->name('searchTRC');
// Route::get('bencana/cari',[BencanaController::class, 'search'])->name('searchBencana');

Route::get('/carinama', [KepulanganController::class, 'getData'])->name('dropdown.data');
// Route::get('selectName', [IndonesiaController::class, 'provinsi'])->name('provinsi.index');

// Route::get('/predict', function () {
//     return view('admin.pengungsi.index');
// });

// web.php


Route::get('/predict', function () {
    return view('admin.predict.index');
});

Route::post('/predict', function (Request $request) {

    $foto = $request->file('foto');

    $response = Http::attach(
        'foto', file_get_contents($foto->getRealPath()), $foto->getClientOriginalName()
    )->post('http://127.0.0.1:8000/predict'); // ini URL backend Docker kamu

    return response()->json($response->json());
});




// Route::post('cadang/delete/{id}', [CadangController::class, 'destroy']);
