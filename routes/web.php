<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\ReasearchController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Room;
use Illuminate\Foundation\Auth\User;
use Illuminate\Routing\Router;
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
    return view('auth.register');
});
// Route::get('/', function () {
//     return view('layout.master');
// });
// 
Route::resource('student',StudentController::class);
Route::resource('teacher',TeacherController::class);
Route::resource('room',RoomController::class);


// Route::middleware(['guest'])->group(function () {

//     Route::controller(UserAuthController::class)->group(function () {
//         Route::get('formlogIn', 'index')->name('login'); 
//         Route::post('custom-login', 'loginUser')->name('userLogin');  
        
//         Route::get('formRegister', 'registration')->name('register');  
//         Route::post('custom-registration', 'customRegistration')->name('customRegistration'); 
//     });
// });


// Route::middleware(['auth'])->group(function () {
//     Route::controller(UserAuthController::class)->group(function () {
//         Route::get('signout', 'signOut')->name('signout');
//     });


// });

Route::controller(UserAuthController::class)->group(function(){
    Route::get('formRegister','registration')->name('register');
    Route::get('formlogIn', 'index')->name('login');
    
    Route::post('custom-registration','customRegistration')->middleware('custom-register')->name('customRegistration');
    Route::post('custom-login', 'loginUser')->middleware('islogedIn')->name('userLogin');


    Route::get('/logout','logout');
});










