<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ActivityController;
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
//     return view('welcome');
// });

//auth route for all user 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

// for admin and teacher
Route::group(['middleware' => ['auth' , 'role:admin|teacher']], function() { 
    Route::get('/accounts/show-accounts', 'App\Http\Controllers\AccountController@showAccounts');
    Route::resource('accounts', AccountController::class);
});

// for teachers
Route::group(['middleware' => ['auth', 'role:teacher']], function() { 
    Route::get('/activities/quizzes/show-quizzes', 'App\Http\Controllers\QuizController@showQuizzes');
    Route::resource('activities/quizzes', QuizController::class);
    Route::resource('activities', ActivityController::class);
});

// for student
Route::group(['middleware' => ['auth', 'role:student']], function() { 
    Route::get('/dashboard/myprofile', 'App\Http\Controllers\DashboardController@myprofile')->name('dashboard.myprofile');
});





require __DIR__.'/auth.php';
