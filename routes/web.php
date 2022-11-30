<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
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


Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('login', [AuthController::class, 'loginPost'])->name('auth.login.post');
Route::get('logout', [AuthController::class, 'logoutPost'])->name('auth.logout');



//----------------- Landing page for all ---------------------//

Route::get('/web', function () {
    return view('welcome');
});

Route::get('/category-details', function () {
    return view('main.portfolio-details');
});

Route::get('/', [LandingPageController::class, 'index'])->name('main.index');

Route::post('sendmessage', [LandingPageController::class, 'sendMessage'])->name('sendMessage');

//----------------- End Landing page for all ---------------------//





//----------------- Admin pages  ---------------------//

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});                                                                                                                //->middleware('auth.admin')
Route::get('editlandingpage', [AdminController::class, 'editLandingPage'])->name('admin.editLandingPage');        //->middleware('auth.admin')
Route::post('background-img-upload', [AdminController::class, 'backgroundImgUpload']);                            //->middleware('auth.admin');
Route::post('aboutus-img-upload', [AdminController::class, 'aboutusImgUpload']);                                  //->middleware('auth.admin')

Route::get('message', [AdminController::class, 'message']);                                        // ->middleware('auth.admin')
Route::get('messageseen', [AdminController::class, 'messageseen']);                                        // ->middleware('auth.admin')

//----------------- End Admin pages  ---------------------//







