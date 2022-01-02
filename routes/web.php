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

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login-aplikasi', [App\Http\Controllers\Auth\LoginController::class, 'login_form'])->name('login_form');
Route::post('/reloadcaptcha', [App\Http\Controllers\Auth\LoginController::class, 'reloadcaptcha'])->name('reloadcaptcha');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['prefix'=>'backend', 'middleware'=>'auth'], function(){
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
	/*MASTER CUSTOMERS*/
    Route::get('customers', [App\Http\Controllers\CustomersController::class, 'index'])->name('customers');
    Route::get('customers/tambah', [App\Http\Controllers\CustomersController::class, 'tambah'])->name('customers.tambah');
    Route::post('customers/add', [App\Http\Controllers\CustomersController::class, 'add'])->name('customers.add');
    Route::get('customers/edit/{id}', [App\Http\Controllers\CustomersController::class, 'edit'])->name('customers.edit');
    Route::post('customers/update', [App\Http\Controllers\CustomersController::class, 'update'])->name('customers.update');
    Route::get('customers/delete/{id}', [App\Http\Controllers\CustomersController::class, 'delete'])->name('customers.delete');

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

	/*MASTER PROVINSI*/
    Route::get('jenis-ikan', [App\Http\Controllers\JenisIkanController::class, 'index'])->name('jenis-ikan');
    Route::get('jenis-ikan/tambah', [App\Http\Controllers\JenisIkanController::class, 'tambah'])->name('jenis-ikan.tambah');
    Route::post('jenis-ikan/add', [App\Http\Controllers\JenisIkanController::class, 'add'])->name('jenis-ikan.add');
    Route::get('jenis-ikan/edit/{id}', [App\Http\Controllers\JenisIkanController::class, 'edit'])->name('jenis-ikan.edit');
    Route::post('jenis-ikan/update', [App\Http\Controllers\JenisIkanController::class, 'update'])->name('jenis-ikan.update');
    Route::get('jenis-ikan/delete/{id}', [App\Http\Controllers\JenisIkanController::class, 'delete'])->name('jenis-ikan.delete');

	/*STOCK IN*/
    Route::get('stock-in', [App\Http\Controllers\StockInController::class, 'index'])->name('stock-in');
    Route::get('stock-in/tambah/{unique_code}', [App\Http\Controllers\StockInController::class, 'tambah'])->name('stock-in.tambah');
    Route::post('stock-in/add', [App\Http\Controllers\StockInController::class, 'add'])->name('stock-in.add');
    Route::post('stock-in/move', [App\Http\Controllers\StockInController::class, 'move'])->name('stock-in.move');
    Route::get('stock-in/view/{id}', [App\Http\Controllers\StockInController::class, 'view'])->name('stock-in.view');
    Route::get('stock-in/delete/{id}', [App\Http\Controllers\StockInController::class, 'delete'])->name('stock-in.delete');
    Route::get('stock-in/getbrand/{id}', [App\Http\Controllers\StockInController::class, 'getbrand'])->name('stock-in.getbrand');
    Route::get('stock-in-tempo/delete/{id}', [App\Http\Controllers\StockInController::class, 'deletetempo'])->name('stock-in-tempo.delete');
    Route::post('stock-in/scan', [App\Http\Controllers\StockInController::class, 'scan'])->name('stock-in.scan');

	/*MASTER USERS*/
    Route::get('users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
    Route::get('users/tambah', [App\Http\Controllers\UsersController::class, 'tambah'])->name('users.tambah');
    Route::post('users/add', [App\Http\Controllers\UsersController::class, 'add'])->name('users.add');
    Route::get('users/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit');
    Route::post('users/update', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
    Route::get('users/delete/{id}', [App\Http\Controllers\UsersController::class, 'delete'])->name('users.delete');

	/*MASTER STOCK LIST*/
    Route::get('stock-list', [App\Http\Controllers\StockListController::class, 'index'])->name('stock-list');
    Route::get('stock-list/edit/{id}', [App\Http\Controllers\StockListController::class, 'edit'])->name('stock-list.edit');
    Route::post('stock-list/update', [App\Http\Controllers\StockListController::class, 'update'])->name('stock-list.update');
    Route::get('stock-list/delete/{id}', [App\Http\Controllers\StockListController::class, 'delete'])->name('stock-list.delete');
    Route::get('stock-list/getbrand/{id}', [App\Http\Controllers\StockListController::class, 'getbrand'])->name('stock-list.getbrand');

	/*MASTER SOURCE*/
    Route::get('source', [App\Http\Controllers\SourceController::class, 'index'])->name('source');
    Route::get('source/tambah', [App\Http\Controllers\SourceController::class, 'tambah'])->name('source.tambah');
    Route::post('source/add', [App\Http\Controllers\SourceController::class, 'add'])->name('source.add');
    Route::get('source/edit/{id}', [App\Http\Controllers\SourceController::class, 'edit'])->name('source.edit');
    Route::post('source/update', [App\Http\Controllers\SourceController::class, 'update'])->name('source.update');
    Route::get('source/delete/{id}', [App\Http\Controllers\SourceController::class, 'delete'])->name('source.delete');

	/*MASTER DELIVERY*/
    Route::get('delivery', [App\Http\Controllers\DeliveryController::class, 'index'])->name('delivery');
    Route::get('delivery/tambah', [App\Http\Controllers\DeliveryController::class, 'tambah'])->name('delivery.tambah');
    Route::post('delivery/add', [App\Http\Controllers\DeliveryController::class, 'add'])->name('delivery.add');
    Route::get('delivery/edit/{id}', [App\Http\Controllers\DeliveryController::class, 'edit'])->name('delivery.edit');
    Route::post('delivery/update', [App\Http\Controllers\DeliveryController::class, 'update'])->name('delivery.update');
    Route::get('delivery/delete/{id}', [App\Http\Controllers\DeliveryController::class, 'delete'])->name('delivery.delete');

	/*MASTER STOCK OUT*/
    Route::get('stock-out', [App\Http\Controllers\StockOutController::class, 'index'])->name('stock-out');
    Route::get('stock-out/tambah', [App\Http\Controllers\StockOutController::class, 'tambah'])->name('stock-out.tambah');
    Route::get('stock-out/tambahtemporary', [App\Http\Controllers\StockOutController::class, 'tambahtemporary'])->name('stock-out.tambahtemporary');
    Route::post('stock-out/add', [App\Http\Controllers\StockOutController::class, 'add'])->name('stock-out.add');
    Route::get('stock-out/getdetailcustomer/{id}', [App\Http\Controllers\StockOutController::class, 'getdetailcustomer'])->name('stock-out.getdetailcustomer');
    Route::get('stock-out/getbrand/{id}', [App\Http\Controllers\StockOutController::class, 'getbrand'])->name('stock-out.getbrand');
    Route::get('stock-out/getexpireddate/{productID}/{provinsiID}', [App\Http\Controllers\StockOutController::class, 'getexpireddate'])->name('stock-out.getexpireddate');
    Route::get('stock-out/getbarcode/{productID}/{provinsiID}/{expiredDate}', [App\Http\Controllers\StockOutController::class, 'getbarcode'])->name('stock-out.getbarcode');
    Route::get('stock-out-tempo/delete/{id}', [App\Http\Controllers\StockOutController::class, 'deletetempo'])->name('stock-out-tempo.delete');
    Route::post('stock-out/move', [App\Http\Controllers\StockOutController::class, 'move'])->name('stock-out.move');
    Route::get('stock-out/view/{id}', [App\Http\Controllers\StockOutController::class, 'view'])->name('stock-out.view');
    Route::get('stock-out/delete/{id}', [App\Http\Controllers\StockOutController::class, 'delete'])->name('stock-out.delete');
    Route::post('stock-out/addcustomer', [App\Http\Controllers\StockOutController::class, 'addcustomer'])->name('stock-out.addcustomer');

	/*ORDERS*/
    Route::get('orders', [App\Http\Controllers\OrdersController::class, 'index'])->name('orders');
    Route::get('orders/view/{id}', [App\Http\Controllers\OrdersController::class, 'view'])->name('orders.view');
    Route::get('orders/view/getbrand/{id}', [App\Http\Controllers\OrdersController::class, 'getbrand'])->name('orders.getbrand');
    Route::get('orders/view/getexpireddate/{productID}/{provinsiID}', [App\Http\Controllers\OrdersController::class, 'getexpireddate'])->name('orders.getexpireddate');
    Route::get('orders/view/getbarcode/{productID}/{provinsiID}/{expiredDate}', [App\Http\Controllers\OrdersController::class, 'getbarcode'])->name('orders.getbarcode');
    Route::get('orders/delete/{id}', [App\Http\Controllers\OrdersController::class, 'delete'])->name('orders.delete');
    Route::post('orders/update', [App\Http\Controllers\OrdersController::class, 'update'])->name('orders.update');
    Route::post('orders/finish', [App\Http\Controllers\OrdersController::class, 'finish'])->name('orders.finish');
    Route::get('orders/export', [App\Http\Controllers\OrdersController::class, 'export'])->name('orders.export');
    Route::get('orders/exportbydates/{from}/{to}', [App\Http\Controllers\OrdersController::class, 'exportbydates'])->name('orders.exportbydates');
    Route::get('orders/deleteproduct/{id}', [App\Http\Controllers\OrdersController::class, 'deleteproduct'])->name('orders.deleteproduct');
    Route::post('orders/updateproduct', [App\Http\Controllers\OrdersController::class, 'updateproduct'])->name('orders.updateproduct');
    Route::post('orders/add', [App\Http\Controllers\OrdersController::class, 'add'])->name('orders.add');
    Route::get('orders/label/{id}', [App\Http\Controllers\OrdersController::class, 'label'])->name('orders.label');

    /*STOCK OPNAME*/
    Route::get('stock-opname', [App\Http\Controllers\StockOpnameController::class, 'index'])->name('stock-opname');
    Route::get('stock-opname/tambah', [App\Http\Controllers\StockOpnameController::class, 'tambah'])->name('stock-opname.tambah');
    Route::post('stock-opname/add', [App\Http\Controllers\StockOpnameController::class, 'add'])->name('stock-opname.add');
    Route::get('stock-opname/detail/{id}', [App\Http\Controllers\StockOpnameController::class, 'detail'])->name('stock-opname.detail');
    Route::post('stock-opname/approve', [App\Http\Controllers\StockOpnameController::class, 'approve'])->name('stock-opname.approve');

    /*REPORT STOCK IN*/
    Route::get('report-stock-in', [App\Http\Controllers\ReportStockInController::class, 'index'])->name('report-stock-in');
    Route::get('report-stock-out', [App\Http\Controllers\ReportStockOutController::class, 'index'])->name('report-stock-out');
    Route::get('report-orders', [App\Http\Controllers\ReportOrdersController::class, 'index'])->name('report-orders');
});
