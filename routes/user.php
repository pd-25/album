<?php

use App\Http\Controllers\user\artist\ArtistController;
use App\Http\Controllers\user\dashboard\DashboardController;
use App\Http\Controllers\user\label\LabelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| artist Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/asset', [DashboardController::class, 'asset'])->name('asset');

    Route::get('/artist-dashboard', [DashboardController::class, 'artistDashboard'])->name('artistDashboard');
    Route::get('/editProfile', [ArtistController::class, 'editProfile'])->name('editProfile');
    Route::resource('/userArtists', ArtistController::class);
    Route::post('/updateProfile', [ArtistController::class, 'updateProfile'])->name('updateProfile');
    Route::resource('labels', LabelController::class);
    });
