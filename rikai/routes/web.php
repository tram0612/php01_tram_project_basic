<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Server\UserController as UserController1;
use App\Http\Controllers\Client\UserController as UserController2;
use App\Http\Controllers\Server\CourseController as CourseController1;
use App\Http\Controllers\Server\CourseSubjectController as CourseSubjectController1;
use App\Http\Controllers\Server\UserCourseController as UserCourseController1;
use App\Http\Controllers\Server\SubjectController as SubjectController1;
use App\Http\Controllers\Server\TaskController as TaskController1;

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
Route::pattern('course','([0-9]+)');
Route::pattern('subject','([0-9]+)');



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
		Route::prefix('course')->name('course.')->group(function(){
			Route::post('/finish', [CourseController1::class, 'finish'])->name('finish');
			Route::post('/status', [CourseSubjectController1::class, 'status'])->name('status');
			Route::post('/sortSubject', [CourseSubjectController1::class, 'sortSubject'])->name('sortSubject');
			Route::get('/{course}/detail', [CourseController1::class, 'detail'])->name('detail');
			Route::get('/{course}/traniee', [UserCourseController1::class, 'index'])->name('trainee');
			Route::get('/{course}/supervisor', [UserCourseController1::class, 'index'])->name('supervisor');
			Route::post('/{course}/addUser', [UserCourseController1::class, 'addUser'])->name('addUser');
			Route::delete('/{course}/user/{user}', [UserCourseController1::class, 'destroy'])->name('delUser');
			Route::get('/{course}/user/{user}', [CourseController1::class, 'progress'])->name('progressUser');
		});
		Route::resource('course.subject', CourseSubjectController1::class);
		Route::resource('course', CourseController1::class)->except(['edit']);
		//route for subject
		Route::resource('subject', SubjectController1::class)->except(['edit']);
		Route::resource('subject.task', TaskController1::class)->except(['edit']);
		Route::prefix('subject')->name('subject.')->group(function(){
			Route::get('/{subject}/detail', [SubjectController1::class, 'detail'])->name('detail');
			Route::post('/finish', [SubjectController1::class, 'finish'])->name('finish');
			Route::post('/sortTask', [TaskController1::class, 'sortTask'])->name('sortTask');
		});
		
	});
 
});