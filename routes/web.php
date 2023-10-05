<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Dashboard\DptController;
use App\Http\Controllers\Dashboard\TpsController;
use App\Http\Controllers\Dashboard\DesaController;
use App\Http\Controllers\Dashboard\MapsController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\PesertaController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\KecamatanController;
use App\Http\Controllers\Dashboard\RealCountController;
use App\Http\Controllers\Dashboard\SimpatisanController;
use App\Http\Controllers\Dashboard\KordinatorDesaController;
use App\Http\Controllers\Dashboard\KordinatorKecamatanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});


Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','isAdmin']], function () {
    Route::get('/', DashboardController::class)->name('dashboard.index');
    //profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('dashboard.profile.index');
    Route::post('/dashboard/profile/update-password/{id}', [ProfileController::class, 'updatePassword'])->name('dashboard.profile.update-password');

    //maps new fitur
    // Route::resource('maps', MapsController::class, ['names' => 'dashboard.maps']);

    //realcount
    Route::resource('realcount', RealCountController::class, ['names' => 'dashboard.realcount']);
    Route::get('tabel/realcount',[RealCountController::class, 'tableRealcount'])->name('dashboard.realcount.tabel');
    Route::get('tabel/realcount/{name}',[RealCountController::class, 'kecamatanRealcount'])->name('dashboard.table.realcount.kecamatan');
    Route::get('tabel/realcount/desa/{name}',[RealCountController::class, 'desaRealcount'])->name('dashboard.table.realcount.desa');

    Route::post('realcount/get/tps',[RealCountController::class, 'getTpsDesaCount'])->name('realcount.get.tps');

    Route::group(['prefix' => 'datamaster'], function () {
        Route::resource('tps', TpsController::class, ['names' => 'dashboard.datamaster.tps']);
        Route::resource('desa', DesaController::class, ['names' => 'dashboard.datamaster.desa']);
        Route::resource('kecamatan', KecamatanController::class, ['names' => 'dashboard.datamaster.kecamatan']);
    });

    Route::group(['prefix' => 'input'], function () {
        Route::resource('kordinator/kecamatan', KordinatorKecamatanController::class, ['names' => 'dashboard.input.kordinator.kecamatan']);
        Route::resource('kordinator', KordinatorDesaController::class, ['names' => 'dashboard.input.kordinator.desa']);
        Route::get('kordinator/desa/{kecamatan}/', [KordinatorDesaController::class, 'kordinator_desa'])->name('dashboard.input.kordinator.desa.name');
        Route::resource('peserta', PesertaController::class, ['names' => 'dashboard.input.peserta'])->except('destroy');
        Route::post('peserta/delete', [PesertaController::class, 'destroy'])->name('dashboard.input.peserta.destroy');
        //getDataTable
        Route::get('peserta/records/relawan',[PesertaController::class, 'data_table'])->name('dashboard.data_table.relawan');
        Route::get('peserta/records/simpatisan',[SimpatisanController::class, 'data_table'])->name('dashboard.data_table.simpatisan');
        Route::resource('simpatisan', SimpatisanController::class, ['names' => 'dashboard.input.simpatisan']);

    });
    Route::resource('dpt', DptController::class, ['names' => 'dashboard.dpt']);
    Route::resource('user', UserController::class, ['names' => 'dashboard.user']);

    //data
    Route::get('data', [DataController::class, 'index'])->name('dashboard.data.index');
    Route::get('data/desa/{name}', [DataController::class, 'desa'])->name('dashboard.data.kecamatan.desa');
    Route::get('data/tps/{name}', [DataController::class, 'tps'])->name('dashboard.data.kecamatan.desa.tps');
    // get data from database
    Route::post('get/desa', [PesertaController::class, 'getdesa'])->name('get.desa');
    Route::post('get/tps', [PesertaController::class, 'gettps'])->name('get.tps');
    // Route::post('get/coordinate/kecamatan', [PesertaController::class, 'getKecamatanCoordinates'])->name('get.coordinate.kecamatan');

    //get Nik
    Route::post('get/nik', [PesertaController::class, 'getnik'])->name('get.nik');
    //get data at the databse
    // Route::post('get/peserta/relawan', [PesertaController::class, 'getPesertaRelawan'])->name('get.peserta.relawan');
    // Route::post('get/peserta/relawan/desa', [PesertaController::class, 'getPesertaRelawanDesa'])->name('get.peserta.relawan.desa');
    // Route::post('get/peserta/relawan/desa/tps', [PesertaController::class, 'getPesertaRelawanTps'])->name('get.peserta.relawan.tps');
    // Route::post('get/peserta/simpatisan', [SimpatisanController::class, 'getPesertaSimpatisan'])->name('get.peserta.simpatisan');
    // Route::post('get/peserta/simpatisan/desa', [SimpatisanController::class, 'getPesertasimpatisanDesa'])->name('get.peserta.simpatisan.desa');
    // Route::post('get/peserta/simpatisan/desa/tps', [SimpatisanController::class, 'getPesertasimpatisanTps'])->name('get.peserta.simpatisan.desa.tps');


    //export peserta
    // Route::get('peserta/page/excel', [PesertaController::class, 'export_page'])->name('dashboard.peserta.data.view');
    Route::get('peserta/export/excel', [PesertaController::class, 'export_excel'])->name('dashboard.peserta.data.export.excel');
    Route::get('peserta/export/pdf', [PesertaController::class, 'generate_pdf'])->name('dashboard.peserta.data.export.pdf');

});
