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
use App\Models\Request;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('department')->group(function(){
    Route::get('/', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::put('update/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
    // Route::get('list', [DepartmentController::class, 'listDepartment'])->name('admin.department.listDepartment');
    // Route::get('add-device-department', [DepartmentController::class, 'formAddDevice'])->name('department.formAddDevice');
    // Route::post('add-device-department', [DepartmentController::class, 'addDevice'])->name('department.get.post.device');
    // Route::get('delete-device-department/{id}/{deparment}', [DepartmentController::class, 'deleteDevice'])->name('department.deleteDevice');
    // Route::get('update-status-device/{id}/{department}', [DepartmentController::class, 'updateStatusDevice'])->name('department.updateStatusDevice');
    // Route::get('/{id}', [DepartmentController::class, 'show'])->name('admin.department.show');
});

Route::prefix('category')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
});

Route::prefix('device')->group(function(){
    Route::get('/', [DeviceController::class, 'index'])->name('device.index');
    Route::get('create', [DeviceController::class, 'create'])->name('device.create');
    Route::post('store', [DeviceController::class, 'store'])->name('device.store');
    Route::get('edit/{id}', [DeviceController::class, 'edit'])->name('device.edit');
    Route::put('update/{id}', [DeviceController::class, 'update'])->name('device.update');
    Route::get('delete/{id}', [DeviceController::class, 'delete'])->name('device.delete');
    Route::get('/category/{category}', [DeviceController::class, 'showByCategory'])->name('device.showByCategory');

});

Route::prefix('software')->group(function(){
    Route::get('/', [SoftwareController::class, 'index'])->name('software.index');
    Route::get('create', [SoftwareController::class, 'create'])->name('software.create');
    Route::post('store', [SoftwareController::class, 'store'])->name('software.store');
    Route::get('edit/{id}', [SoftwareController::class, 'edit'])->name('software.edit');
    Route::put('update/{id}', [SoftwareController::class, 'update'])->name('software.update');
    Route::get('delete/{id}', [SoftwareController::class, 'delete'])->name('software.delete');
});

Route::prefix('user')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('create', [UserController::class, 'create'])->name('user.create');
    Route::post('store', [UserController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});

Route::prefix('request')->group(function(){
    Route::get('/borrow-device', [RequestController::class, 'showBorrowForm'])->name('request.showBorrowForm');
    Route::post('/send-borrow-request', [RequestController::class, 'sendBorrorRequest'])->name('request.sendBorrowRequest');
    Route::get('/return-device/{id}', [RequestController::class, 'sendReturnRequest'])->name('request.sendReturnRequest');
    Route::get('/roport-device-broken/{id}', [RequestController::class, 'reportDeviceBroken'])->name('request.reportDeviceBroken');

    Route::get('/list-request', [RequestController::class, 'listRequest'])->name('request.listRequest');
    Route::get('/list-request-borrow', [RequestController::class, 'listRequestBorrow'])->name('request.listRequestBorrow');
    Route::get('/approve/{id}', [RequestController::class, 'approveRequest'])->name('request.approveRequest');
    Route::get('/refuse/{id}', [RequestController::class, 'refuseRequest'])->name('request.refuseRequest');
    Route::get('/provide/{id}', [RequestController::class, 'provideDeviceForm'])->name('request.provideDeviceForm');
    Route::post('/provide', [RequestController::class, 'provideDevice'])->name('request.provideDevice');
    // Route::put('/provide/{id}', [RequestController::class, 'provideDeviceConfirm'])->name('request.provideDeviceConfirm');
    Route::put('/recall/department{id}/user{id}', [RequestController::class, 'recallDevice'])->name('request.recallDevice');
    Route::get('/delivered/{user_id}', [RequestController::class, 'formDelivered'])->name('request.formDelivered');
    Route::post('/delivered/{user_id}', [RequestController::class, 'delivered'])->name('request.delivered');
    Route::get('list-device-borrow', [RequestController::class, 'listDeviceBorrow'])->name('request.listDeviceBorrow');
});
