<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

Route::prefix('user')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('create', [UserController::class, 'create'])->name('user.create');
    Route::post('store', [UserController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});