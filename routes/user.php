<?php

use App\Http\Controllers\user\artist\ArtistController;
use App\Http\Controllers\user\asset\AssetController;
use App\Http\Controllers\user\dashboard\DashboardController;
use App\Http\Controllers\user\label\LabelController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\OtherKeyArtistController;
use App\Http\Controllers\DistributeController;
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
    Route::resource('/asset', AssetController::class);
    Route::post('/asset/update', [AssetController::class, 'update']);
    Route::post('/asset/update/track', [AssetController::class, 'Updatetracks']);
    Route::post('/asset/add/track', [AssetController::class, 'addNewtracks']);
    Route::post('/asset/delete/track', [AssetController::class, 'deletetrack']);

    Route::post('/asset/add/publishing', [AssetController::class, 'addNewpublishing']);
    Route::post('/asset/update/publishing', [AssetController::class, 'Updatepublishing']);
    Route::post('/asset/delete/publishing', [AssetController::class, 'deletepublishing']);


    Route::get('/artist-dashboard', [DashboardController::class, 'artistDashboard'])->name('artistDashboard');
    Route::get('/dashboard/{news}/news', [DashboardController::class, 'newsDetails'])->name("user.newsDetails");

    Route::get('/dashboard/barchart/{year}', [DashboardController::class, 'Dashboardbarchart'])->name('Dashboard.barchart');


    Route::get('/editProfile', [ArtistController::class, 'editProfile'])->name('editProfile');
    Route::resource('/userArtists', ArtistController::class);

    Route::post('add-user-Artists', [ArtistController::class,'userstore']);

    Route::get('single-artists-list/{userid}', [ArtistController::class,'GetArtistDetails']);
    Route::get('artists-list', [ArtistController::class,'Artistindex']);

    Route::post('/updateProfile', [ArtistController::class, 'updateProfile'])->name('updateProfile');
    Route::resource('labels', LabelController::class);

    Route::get('support-ticekt', [SupportTicketController::class,'index'])->name('support.index');
    Route::post('support-ticekt/store', [SupportTicketController::class,'store'])->name('support.store');
    Route::get('support-ticekt/message/{message}', [SupportTicketController::class,'showmessage'])->name('support.showmessage');

    Route::post('support-ticekt/send-message', [SupportTicketController::class,'SendMessage'])->name('support.sendmessage');

    Route::get('/wallet', [WalletController::class,'create'])->name('wallet.create');
    Route::post('/wallet/userstore', [WalletController::class, 'userstore'])->name('wallet.userstore');


    Route::post('/store-other-key-artist', [OtherKeyArtistController::class,'store'])->name('otherkey.store');
    Route::get('/get-other-key-artist', [OtherKeyArtistController::class,'index'])->name('otherkey.index');

    Route::get('/distributions/{id}/details', [DistributeController::class,'index'])->name('distribute.index');
    Route::get('/create-distribute/{id?}', [DistributeController::class,'create'])->name('distribute.create');
    Route::post('/store-distribute', [DistributeController::class,'store'])->name('distribute.store');

    
});
