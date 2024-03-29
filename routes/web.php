<?php

use App\Http\Controllers\admin\artist\ArtistController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\dashboard\DashboardController;
use App\Http\Controllers\admin\label\LabelController;
use App\Http\Controllers\admin\user\UserController;
use App\Http\Controllers\admin\asset\AssetsController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StorePermissionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/run', function () {
    // Run an Artisan command
    Artisan::call('optimize:clear', [
        // Command options and arguments go here
    ]);

    // Get the output of the command
    $output = Artisan::output();

    return "Command executed. Output: $output";
});

Auth::routes();

Route::get('admin/login', [AuthController::class, 'showLogin'])->name('admin.showlogin');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    // Route::get('admin-profile', [DashboardController::class, 'adminProfile'])->name('admin.adminProfile');
    // Route::post('admin-profile', [DashboardController::class, 'adminProfileUpdate'])->name('admin.profile');
    // Route::post('admin-password', [DashboardController::class, 'changePassword'])->name('admin.changePassword');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name("admin.dashboard");
    Route::resource('users', UserController::class);
    Route::resource('artists', ArtistController::class);
    
    Route::get('artists-list/{userid}', [ArtistController::class,'GetArtistDetails']);
    Route::get('artists-list', [ArtistController::class,'Artistindex']);


    Route::resource('label', LabelController::class);    
    Route::get('log-out', [AuthController::class, 'adminLogout'])->name('admin.logout');
    
    Route::get('/asset', [AssetsController::class, 'index'])->name("admin.index");
    Route::get('/asset/create', [AssetsController::class, 'create'])->name("admin.create");
    Route::post('/asset/store', [AssetsController::class, 'store'])->name("admin.store");
    Route::get('/asset/{asset}/edit', [AssetsController::class, 'edit'])->name("admin.edit");
    Route::post('/asset/update', [AssetsController::class, 'update'])->name("admin.update");
    Route::delete('/asset/{asset}', [AssetsController::class, 'destroy'])->name("admin.destroy");
    Route::post('/asset/status', [AssetsController::class, 'status'])->name("admin.status");

    Route::get('/store', [StoreController::class, 'index'])->name("store.index");
    Route::get('/store/create', [StoreController::class, 'create'])->name("store.create");
    Route::post('/store/store', [StoreController::class, 'store'])->name("store.store");
    Route::get('/store/{store}/edit', [StoreController::class, 'edit'])->name("store.edit");
    Route::delete('/store/{store}', [StoreController::class, 'destroy'])->name("store.destroy");

    Route::get('/store-permission', [StorePermissionController::class, 'index'])->name("storePermission.index");
    Route::POST('/storepermission-store', [StorePermissionController::class, 'store'])->name("StorePermissionController.store");
    Route::get('/storepermission/create', [StorePermissionController::class, 'create'])->name("storePermission.create");
});


