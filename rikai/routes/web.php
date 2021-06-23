<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Server\UserController;
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
Route::pattern('id','([0-9]+)');

Route::get('/signin', [LoginController::class, 'getLogin'])->name('signin');
Route::post('/signin', [LoginController::class, 'postLogin'])->name('signin');
Route::get('/signout', [LoginController::class, 'logout'])->name('signout');



// Route::group([
//     'name' => 'server.',
//     'prefix' => 'server',
//     'namespace' => 'Server',
//     'middleware' => 'admin',
// ], function () {

// 	Route::group([
// 	    'name' => 'user.',
// 	    'prefix' => 'user',
// 	    ], function () {
// 			Route::get('profile', [UserController::class, 'profile'])->name('profile');
// 	    });
   
// });
// Route::get('/profile', function () {
// 	//return bcrypt('11111111');
//     return view('server.user.profile');
// });


