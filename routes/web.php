<?php

use App\Http\Controllers\admin\artist\ArtistController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\dashboard\DashboardController;
use App\Http\Controllers\admin\label\LabelController;
use App\Http\Controllers\admin\user\UserController;
use App\Http\Controllers\admin\asset\AssetsController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StorePermissionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\OtherKeyArtistController;
use App\Http\Controllers\DistributeController;

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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    echo('storage link successfully');
});

Auth::routes();

Route::get('admin/login', [AuthController::class, 'showLogin'])->name('admin.showlogin');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    // Route::get('admin-profile', [DashboardController::class, 'adminProfile'])->name('admin.adminProfile');
    // Route::post('admin-profile', [DashboardController::class, 'adminProfileUpdate'])->name('admin.profile');
    // Route::post('admin-password', [DashboardController::class, 'changePassword'])->name('admin.changePassword');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name("admin.dashboard");
    Route::get('/dashboard/{news}/news', [DashboardController::class, 'newsDetails'])->name("admin.newsDetails");
    Route::resource('users', UserController::class);
    Route::resource('artists', ArtistController::class);
    
    Route::get('single-artists-list/{userid}', [ArtistController::class,'GetArtistDetails']);
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

    Route::post('/asset/update/track', [AssetsController::class, 'Updatetracks']);
    Route::post('/asset/add/track', [AssetsController::class, 'addNewtracks']);
    Route::post('/asset/delete/track', [AssetsController::class, 'deletetrack']);

    Route::post('/asset/add/publishing', [AssetsController::class, 'addNewpublishing']);
    Route::post('/asset/update/publishing', [AssetsController::class, 'Updatepublishing']);
    Route::post('/asset/delete/publishing', [AssetsController::class, 'deletepublishing']);



    Route::get('/store', [StoreController::class, 'index'])->name("store.index");
    Route::get('/store/create', [StoreController::class, 'create'])->name("store.create");
    Route::post('/store/store', [StoreController::class, 'store'])->name("store.store");
    Route::get('/store/{store}/edit', [StoreController::class, 'edit'])->name("store.edit");
    Route::delete('/store/{store}', [StoreController::class, 'destroy'])->name("store.destroy");

    Route::get('/store-permission', [StorePermissionController::class, 'index'])->name("storePermission.index");
    Route::POST('/storepermission-store', [StorePermissionController::class, 'store'])->name("StorePermissionController.store");
    Route::get('/storepermission/create', [StorePermissionController::class, 'create'])->name("storePermission.create");

    Route::get('/news', [NewsController::class, 'index'])->name("news.index");
    Route::get('/news/create', [NewsController::class, 'create'])->name("news.create");
    Route::post('/news/store', [NewsController::class, 'store'])->name("news.store");
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name("news.edit");
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name("news.destroy");

    Route::get('/category', [SupportTicketController::class, 'categoryindex'])->name("category.index");
    Route::post('/category/store', [SupportTicketController::class, 'categorystore'])->name("category.store");

    Route::get('/support-ticekts', [SupportTicketController::class,'create'])->name('support.create');
    Route::get('support-ticekts/show-message/{message}', [SupportTicketController::class,'adminmessageshow'])->name('support.adminmessageshow');
    Route::post('support-ticekt/send-message', [SupportTicketController::class,'AdminSendMessage'])->name('support.AdminSendMessage');
    Route::post('/support-ticekt/status', [SupportTicketController::class, 'status']);
    Route::get('/support-ticekts/history', [SupportTicketController::class,'tickethistory'])->name('support.tickethistory');

    Route::get('/wallet', [WalletController::class,'index'])->name('wallet.index');
    Route::post('/wallet/store', [WalletController::class, 'store'])->name('wallet.store');
    Route::delete('/wallet/{wallet}', [WalletController::class, 'destroy'])->name("wallet.destroy");
    Route::get('/wallet/withdrawal-request', [WalletController::class,'show'])->name('wallet.withdrawalRequest');
    Route::post('/wallet/update', [WalletController::class, 'update'])->name('wallet.update');

    Route::get('/wallet/user-balance/{id}', [WalletController::class,'getUserBalance']);
    Route::post('/wallet/withdraw-store', [WalletController::class, 'userstore'])->name('wallet.withdrawalstore');


    Route::get('/roles', [RolesController::class,'index'])->name('roles.index');
    Route::post('/roles/store', [RolesController::class,'store'])->name('roles.store');
    Route::delete('/roles/{roles}', [RolesController::class, 'destroy'])->name("roles.destroy");

    Route::post('/store-other-key-artist', [OtherKeyArtistController::class,'store'])->name('otherkey.store');
    Route::get('/get-other-key-artist', [OtherKeyArtistController::class,'create'])->name('otherkey.create');

    Route::get('/distributions/{id}/details', [DistributeController::class,'Adminindex'])->name('distribute.Adminindex');
    Route::get('/create-distribute/{id?}', [DistributeController::class,'Admincreate'])->name('distribute.Admincreate');
    Route::post('/store-distribute', [DistributeController::class,'Adminstore'])->name('distribute.Adminstore');
    Route::post('/store-distribute-Delivered', [DistributeController::class,'AdminDelivered'])->name('distribute.AdminDelivered');
});


