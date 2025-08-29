<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanitiaUtamaController;
use App\Http\Controllers\WaliUtamaController;
use App\Http\Controllers\MuridUtamaController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Auth Scaffolding (laravel/ui)
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Guest -> redirect ke login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('panitia-utama.index');
})->middleware('auth')->name('home');

/*
|--------------------------------------------------------------------------
| Protected Routes (wajib login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // ===== Panitia Utama =====
    Route::resource('panitia-utama', PanitiaUtamaController::class);
    Route::get('panitia-utama-export', [PanitiaUtamaController::class, 'exportExcel'])->name('panitia.export');
    Route::post('panitia-utama-import', [PanitiaUtamaController::class, 'importExcel'])->name('panitia.import');
    Route::get('panitia-utama/{id}/idcard', [PanitiaUtamaController::class, 'generateIdCard'])->name('panitia.idcard');
    Route::get('panitia-utama-idcards', [PanitiaUtamaController::class, 'generateAllIdCards'])->name('panitia.idcards');

    // AJAX wilayah (laravolt/indonesia)
    Route::get('/get-kabupaten/{provinsi}', [PanitiaUtamaController::class, 'getKabupaten']);
    Route::get('/get-kecamatan/{kabupaten}', [PanitiaUtamaController::class, 'getKecamatan']);
    Route::get('/get-desa/{kecamatan}', [PanitiaUtamaController::class, 'getDesa']);

    // ===== Wali Utama =====
    Route::resource('wali-utama', WaliUtamaController::class);
    Route::get('wali-utama-export', [WaliUtamaController::class,'exportExcel'])->name('wali-utama.export');
    Route::post('wali-utama-import', [WaliUtamaController::class,'importExcel'])->name('wali-utama.import');

    // ===== Murid Utama =====
    Route::resource('murid-utama', MuridUtamaController::class);
    Route::prefix('murid-utama')->name('murid-utama.')->group(function () {
        Route::get('/template', [MuridUtamaController::class, 'template'])->name('template');
        Route::get('/export', [MuridUtamaController::class, 'export'])->name('export');
        Route::post('/import', [MuridUtamaController::class, 'import'])->name('import');
    });
});

/*
|--------------------------------------------------------------------------
| Home (default laravel)
|--------------------------------------------------------------------------
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
