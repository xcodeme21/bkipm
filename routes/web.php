<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login-aplikasi', [App\Http\Controllers\Auth\LoginController::class, 'login_form'])->name('login_form');
Route::post('/reloadcaptcha', [App\Http\Controllers\Auth\LoginController::class, 'reloadcaptcha'])->name('reloadcaptcha');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//frontend
Route::group(['prefix'=>'pp'], function(){
    Route::get('/provinsi', [App\Http\Controllers\HomeController::class, 'ppprov'])->name('fe.pp.provinsi');
});

Route::group(['prefix'=>'backend', 'middleware'=>'auth'], function(){
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('logo', [App\Http\Controllers\LogoController::class, 'index'])->name('logo');
    Route::post('logo/update', [App\Http\Controllers\LogoController::class, 'update'])->name('logo.update');
    
	/*MASTER JENIS USAHA*/
    Route::get('jenis-usaha', [App\Http\Controllers\JenisUsahaController::class, 'index'])->name('jenis-usaha');
    Route::get('jenis-usaha/tambah', [App\Http\Controllers\JenisUsahaController::class, 'tambah'])->name('jenis-usaha.tambah');
    Route::post('jenis-usaha/add', [App\Http\Controllers\JenisUsahaController::class, 'add'])->name('jenis-usaha.add');
    Route::get('jenis-usaha/edit/{id}', [App\Http\Controllers\JenisUsahaController::class, 'edit'])->name('jenis-usaha.edit');
    Route::post('jenis-usaha/update', [App\Http\Controllers\JenisUsahaController::class, 'update'])->name('jenis-usaha.update');
    Route::get('jenis-usaha/delete/{id}', [App\Http\Controllers\JenisUsahaController::class, 'delete'])->name('jenis-usaha.delete');

	/*MASTER PROVINSI*/
    Route::get('provinsi', [App\Http\Controllers\ProvinsiController::class, 'index'])->name('provinsi');
    Route::get('provinsi/tambah', [App\Http\Controllers\ProvinsiController::class, 'tambah'])->name('provinsi.tambah');
    Route::post('provinsi/add', [App\Http\Controllers\ProvinsiController::class, 'add'])->name('provinsi.add');
    Route::get('provinsi/edit/{id}', [App\Http\Controllers\ProvinsiController::class, 'edit'])->name('provinsi.edit');
    Route::post('provinsi/update', [App\Http\Controllers\ProvinsiController::class, 'update'])->name('provinsi.update');
    Route::get('provinsi/delete/{id}', [App\Http\Controllers\ProvinsiController::class, 'delete'])->name('provinsi.delete');

	/*MASTER JENIS IKAN*/
    Route::get('jenis-ikan', [App\Http\Controllers\JenisIkanController::class, 'index'])->name('jenis-ikan');
    Route::get('jenis-ikan/tambah', [App\Http\Controllers\JenisIkanController::class, 'tambah'])->name('jenis-ikan.tambah');
    Route::post('jenis-ikan/add', [App\Http\Controllers\JenisIkanController::class, 'add'])->name('jenis-ikan.add');
    Route::get('jenis-ikan/edit/{id}', [App\Http\Controllers\JenisIkanController::class, 'edit'])->name('jenis-ikan.edit');
    Route::post('jenis-ikan/update', [App\Http\Controllers\JenisIkanController::class, 'update'])->name('jenis-ikan.update');
    Route::get('jenis-ikan/delete/{id}', [App\Http\Controllers\JenisIkanController::class, 'delete'])->name('jenis-ikan.delete');

	/*MASTER USERS*/
    Route::get('users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
    Route::get('users/tambah', [App\Http\Controllers\UsersController::class, 'tambah'])->name('users.tambah');
    Route::post('users/add', [App\Http\Controllers\UsersController::class, 'add'])->name('users.add');
    Route::get('users/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit');
    Route::post('users/update', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
    Route::get('users/delete/{id}', [App\Http\Controllers\UsersController::class, 'delete'])->name('users.delete');

    Route::group(['prefix'=>'produksi-perikanan'], function(){
        /*PRODUKSI PERIKANAN PROVINSI*/
        Route::get('provinsi', [App\Http\Controllers\PpProvinsiController::class, 'index'])->name('pp.provinsi');
        Route::get('provinsi/tambah', [App\Http\Controllers\PpProvinsiController::class, 'tambah'])->name('pp.provinsi.tambah');
        Route::post('provinsi/add', [App\Http\Controllers\PpProvinsiController::class, 'add'])->name('pp.provinsi.add');
        Route::get('provinsi/edit/{id}', [App\Http\Controllers\PpProvinsiController::class, 'edit'])->name('pp.provinsi.edit');
        Route::post('provinsi/update', [App\Http\Controllers\PpProvinsiController::class, 'update'])->name('pp.provinsi.update');
        Route::get('provinsi/delete/{id}', [App\Http\Controllers\PpProvinsiController::class, 'delete'])->name('pp.provinsi.delete');
    });

    Route::group(['prefix'=>'impor'], function(){
        /*VOLUME*/
        Route::get('volume', [App\Http\Controllers\ImporController::class, 'index'])->name('impor.volume');
        Route::get('volume/tambah', [App\Http\Controllers\ImporController::class, 'tambah'])->name('impor.volume.tambah');
        Route::post('volume/add', [App\Http\Controllers\ImporController::class, 'add'])->name('impor.volume.add');
        Route::get('volume/edit/{id}', [App\Http\Controllers\ImporController::class, 'edit'])->name('impor.volume.edit');
        Route::post('volume/update', [App\Http\Controllers\ImporController::class, 'update'])->name('impor.volume.update');
        Route::get('volume/delete/{id}', [App\Http\Controllers\ImporController::class, 'delete'])->name('impor.volume.delete');
        
        /*FREKUENSI*/
        Route::get('frekuensi', [App\Http\Controllers\ImporController::class, 'indexFrekuensi'])->name('impor.frekuensi');
    });

    Route::group(['prefix'=>'ekspor'], function(){
        /*VOLUME*/
        Route::get('volume', [App\Http\Controllers\EksporController::class, 'index'])->name('ekspor.volume');
        Route::get('volume/tambah', [App\Http\Controllers\EksporController::class, 'tambah'])->name('ekspor.volume.tambah');
        Route::post('volume/add', [App\Http\Controllers\EksporController::class, 'add'])->name('ekspor.volume.add');
        Route::get('volume/edit/{id}', [App\Http\Controllers\EksporController::class, 'edit'])->name('ekspor.volume.edit');
        Route::post('volume/update', [App\Http\Controllers\EksporController::class, 'update'])->name('ekspor.volume.update');
        Route::get('volume/delete/{id}', [App\Http\Controllers\EksporController::class, 'delete'])->name('ekspor.volume.delete');
        
        /*FREKUENSI*/
        Route::get('frekuensi', [App\Http\Controllers\EksporController::class, 'indexFrekuensi'])->name('ekspor.frekuensi');
    });
});
