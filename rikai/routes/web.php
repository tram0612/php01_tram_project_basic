<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Server\UserController as UserController1;

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
// Route::get('/', function () {
// 			return bcrypt('11111111');
// 		});

Route::pattern('user','([0-9]+)');

Route::get('/signin', [LoginController::class, 'getLogin'])->name('signin');
Route::post('/signin', [LoginController::class, 'postLogin'])->name('signin');
Route::get('/signout', [LoginController::class, 'logout'])->name('signout');
Route::prefix('server')->name('server.')->group(function(){
 Route::middleware(['admin'])->group(function () {
 	Route::get('/', function () {
			return view('server.index');
		})->name('index');
		//route for user
		Route::resource('user', UserController1::class)->except(['index','edit']);
		Route::get('/trainee', [UserController1::class, 'trainee'])->name('user.trainee');
		Route::get('/supervisor', [UserController1::class, 'supervisor'])->name('user.supervisor');
		//route for course
		
		
	});
 
});

