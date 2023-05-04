<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\Api\HomeController as HomeApiController;
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
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/get-devices-info', [HomeApiController::class, 'getDevicesInfo'])->name('getDevicesInfo');
Route::get('/get-requests-info', [HomeApiController::class, 'getRequestsInfo'])->name('getRequestsInfo');
Route::get('/get-requests-by-day', [HomeApiController::class, 'getRequestByDay'])->name('getRequestByDay');

Route::prefix('departments')->group(function(){
    Route::get('/', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::put('update/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
});

Route::prefix('categories')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
});

Route::prefix('devices')->group(function(){
    Route::get('/', [DeviceController::class, 'index'])->name('device.index');
    Route::get('create', [DeviceController::class, 'create'])->name('device.create');
    Route::post('store', [DeviceController::class, 'store'])->name('device.store');
    Route::get('edit/{id}', [DeviceController::class, 'edit'])->name('device.edit');
    Route::put('update/{id}', [DeviceController::class, 'update'])->name('device.update');
    Route::get('delete/{id}', [DeviceController::class, 'delete'])->name('device.delete');
    Route::get('/category/{category}', [DeviceController::class, 'showByCategory'])->name('device.showByCategory');
    Route::get('device-repairing', [DeviceController::class, 'listDeviceRepairing'])->name('device.listDeviceRepairing');
    Route::get('device-brokening', [DeviceController::class, 'listDeviceBrokening'])->name('device.listDeviceBrokening');
    Route::get('device-warranting', [DeviceController::class, 'listDeviceWarranting'])->name('device.listDeviceWarranting');
    Route::get('device-warantied-repaired', [DeviceController::class, 'listDeviceWarrantiedOrRepaired'])->name('device.listDeviceWarrantiedOrRepaired');
    Route::get('device-warantied-repaired/{id}', [DeviceController::class, 'detailDeviceWarrantiedOrRepaired'])->name('device.detailDeviceWarrantiedOrRepaired');
});

Route::prefix('softwares')->group(function(){
    Route::get('/', [SoftwareController::class, 'index'])->name('software.index');
    Route::get('create', [SoftwareController::class, 'create'])->name('software.create');
    Route::post('store', [SoftwareController::class, 'store'])->name('software.store');
    Route::get('edit/{id}', [SoftwareController::class, 'edit'])->name('software.edit');
    Route::put('update/{id}', [SoftwareController::class, 'update'])->name('software.update');
    Route::get('delete/{id}', [SoftwareController::class, 'delete'])->name('software.delete');
    Route::get('software-device', [SoftwareController::class, 'listSoftwareByDevice'])->name('software.listSoftwareByDevice');
});

Route::prefix('users')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('create', [UserController::class, 'create'])->name('user.create');
    Route::post('store', [UserController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('profile/{id}', [UserController::class, 'profile'])->name('user.profile');
    Route::put('profile/{id}', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::get('change-password/{id}', [UserController::class, 'changePasswordForm'])->name('user.changePasswordForm');
    Route::put('change-password/{id}', [UserController::class, 'changePassword'])->name('user.changePassword');

});

Route::prefix('requests')->group(function(){
    Route::get('/borrow-device', [RequestController::class, 'showBorrowForm'])->name('request.showBorrowForm');
    Route::post('/send-borrow-request', [RequestController::class, 'sendBorrorRequest'])->name('request.sendBorrowRequest');
    Route::get('/borrow-licensekey/{device_id}', [RequestController::class, 'showBorrowFormLicensekey'])->name('request.showBorrowFormLicensekey');
    Route::post('/send-borrow-licensekey/{device_id}', [RequestController::class, 'sendBorrorRequestLicensekey'])->name('request.sendBorrowRequestLicensekey');
    Route::get('/return-device/{id}', [RequestController::class, 'sendReturnRequest'])->name('request.sendReturnRequest');
    Route::get('/report-device-broken/{id}', [RequestController::class, 'reportDeviceBroken'])->name('request.reportDeviceBroken');

    Route::get('/list-request', [RequestController::class, 'listRequest'])->name('request.listRequest');
    Route::get('/list-request-borrow', [RequestController::class, 'listRequestBorrow'])->name('request.listRequestBorrow');
    Route::get('/list-request-return', [RequestController::class, 'listRequestReturn'])->name('request.listRequestReturn');
    Route::get('/list-request-broken', [RequestController::class, 'listRequestBroken'])->name('request.listRequestBroken');
    Route::get('/list-request-user', [RequestController::class, 'listRequestByUser'])->name('request.listRequestByUser');
    Route::get('/list-request-license-key', [RequestController::class, 'listRequestLicenseKey'])->name('request.listRequestLicenseKey');
    Route::get('/approve/{id}', [RequestController::class, 'approveRequest'])->name('request.approveRequest');
    Route::get('/refuse/{id}', [RequestController::class, 'refuseRequest'])->name('request.refuseRequest');
    Route::get('/provide/{id}', [RequestController::class, 'provideDeviceForm'])->name('request.provideDeviceForm');
    Route::post('/provide', [RequestController::class, 'provideDevice'])->name('request.provideDevice');

    Route::get('/provide-licensekey/{user_id}/{device_id}', [RequestController::class, 'provideLicenseKeyForm'])->name('request.provideLicenseKeyForm');
    Route::post('/provide-licensekey', [RequestController::class, 'provideLicenseKey'])->name('request.provideLicenseKey');

    // Route::put('/provide/{id}', [RequestController::class, 'provideDeviceConfirm'])->name('request.provideDeviceConfirm');
    // Route::put('/recall/department{id}/user{id}', [RequestController::class, 'recallDevice'])->name('request.recallDevice');
    Route::get('/delivered/{user_id}', [RequestController::class, 'formDelivered'])->name('request.formDelivered');
    Route::post('/delivered/{user_id}', [RequestController::class, 'delivered'])->name('request.delivered');
    Route::get('list-device-borrow', [RequestController::class, 'listDeviceBorrow'])->name('request.listDeviceBorrow');
    Route::get('list-device-borrowed', [RequestController::class, 'listDeviceBorrowed'])->name('request.listDeviceBorrowed');
    Route::get('list-device-available', [RequestController::class, 'listDeviceAvailabale'])->name('request.listDeviceAvailabale');
});

Route::prefix('repairs')->group(function(){
    Route::get('device/{device_id}', [RepairController::class, 'repairDevice'])->name('repair.repairDevice');
    Route::get('device/repaired/{device_id}', [RepairController::class, 'repairDeviceForm'])->name('repair.repairDeviceForm');
    Route::post('device/repaired/{id}', [RepairController::class, 'repairDeviced'])->name('repair.repairDeviced');

});

Route::prefix('warranties')->group(function(){
    Route::get('device/{device_id}', [WarrantyController::class, 'warrantyDevice'])->name('warranty.warrantyDevice');
    Route::get('device/warrantied/{device_id}', [WarrantyController::class, 'warrantyDeviceForm'])->name('warranty.warrantyDeviceForm');
    Route::post('device/warrantied/{id}', [WarrantyController::class, 'warrantyDeviced'])->name('warranty.warrantyDeviced');
});
