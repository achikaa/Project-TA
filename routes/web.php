<?php

use App\Http\Controllers\GanttChartController;
use App\Models\QFD\ManagementTruck;
use App\Models\QFD\ManagementPicProduct;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('login-in', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//DASHBOARD
Route::get('/qfd-dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/schedule', [App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/gantt-chart', function () {
return view('gantt-chart');
});

// PIC PRODUCT
Route::get('/management-pic-product', [App\Http\Controllers\QFD\PPC\PICproductController::class, 'index2']);
Route::post('/pic-store', [App\Http\Controllers\QFD\PPC\PICproductController::class, 'store']);
Route::get('/pic-edit', [App\Http\Controllers\QFD\PPC\PICproductController::class, 'edit']);
Route::post('/pic-update', [App\Http\Controllers\QFD\PPC\PICproductController::class, 'update']);
Route::post('/pic-delete', [App\Http\Controllers\QFD\PPC\PICproductController::class, 'destroy']);
Route::get('/getEmail', [App\Http\Controllers\QFD\PPC\PICproductController::class, 'getEmail']);

// TRUCK
Route::get('/management-truck', [App\Http\Controllers\QFD\Admin\ManagementTruckController::class, 'index']);
Route::post('/truck-store', [App\Http\Controllers\QFD\Admin\ManagementTruckController::class, 'store']);
Route::get('/truck-edit', [App\Http\Controllers\QFD\Admin\ManagementTruckController::class, 'edit']);
Route::post('/truck-update', [App\Http\Controllers\QFD\Admin\ManagementTruckController::class, 'update']);
Route::post('/truck-delete', [App\Http\Controllers\QFD\Admin\ManagementTruckController::class, 'destroy']);

// PROGRESS QFD
Route::get('/management-progress', [App\Http\Controllers\QFD\Admin\ManagementProgressQfdController::class, 'index']);
Route::post('/proses-store', [App\Http\Controllers\QFD\Admin\ManagementProgressQfdController::class, 'store']);
Route::get('/proses-edit', [App\Http\Controllers\QFD\Admin\ManagementProgressQfdController::class, 'edit']);
Route::post('/proses-update', [App\Http\Controllers\QFD\Admin\ManagementProgressQfdController::class, 'update']);
Route::post('/proses-delete', [App\Http\Controllers\QFD\Admin\ManagementProgressQfdController::class, 'destroy']);

// END CUSTOMER
Route::get('/management-end-customer', [App\Http\Controllers\QFD\Admin\ManagementEndCustomerController::class, 'index']);
Route::post('/customer-store', [App\Http\Controllers\QFD\Admin\ManagementEndCustomerController::class, 'store']);
Route::get('/customer-edit', [App\Http\Controllers\QFD\Admin\ManagementEndCustomerController::class, 'edit']);
Route::post('/customer-update', [App\Http\Controllers\QFD\Admin\ManagementEndCustomerController::class, 'update']);
Route::post('/customer-delete', [App\Http\Controllers\QFD\Admin\ManagementEndCustomerController::class, 'destroy']);

// QUALITY FOR DELIVERY
Route::get('/quality-for-delivery', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'new']);
Route::get('/quality-for-delivery-ongoing', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'ongoing']);
Route::get('/quality-for-delivery-finish', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'finish']);
Route::post('/qfd-store', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'store']);
Route::get('/qfd-edit', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'edit']);
Route::post('/qfd-update', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'update']);
Route::post('/qfd-delete', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'destroy']);
Route::get('/getCustomer', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'getCustomer']);
Route::get('/getCustomerPO', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'getCustomerPO']);
Route::get('/getProjectName', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'getProjectName']);
Route::get('/getQuantity', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'getQuantity']);
Route::get('/getReqDelivery', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'getReqDelivery']);
Route::get('/getQuantity', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'getQuantity']);
//DETAIL MEETING QFD
Route::get('/detail-project-new/{pname}', [App\Http\Controllers\QFD\Admin\QualityForDeliveryController::class, 'detailProjectnew']);
// Route::get('/detail-meeting-qfd/', [App\Http\Controllers\QFD\Admin\DetailMeetingQFDController::class, 'index']);
Route::get('/create-notulensi', [App\Http\Controllers\QFD\Admin\CreateNotulensiController::class, 'index']);

