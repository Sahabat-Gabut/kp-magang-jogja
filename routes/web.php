<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController};
use App\Http\Livewire\{Apprentice};
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
Route::get('/', function () {
    return view('pages.guest.index');
})->name('home');

Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    // Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::view('pendaftaran-magang', 'pages.guest.registration')->name('pendaftaran-magang');
    
    Route::get('dashboard',function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

    Route::get('profile',function () {
        return view('pages.dashboard.profile.index');
    })->name('profile');
    
    // Attendence 
    Route::get('attendance',function () {
        return view('pages.dashboard.attendance.index');
    })->name('attendance');

    // Submission 
    Route::get('/submission',function () {
        return view('pages.dashboard.submission.index');
    })->name('submission');

    // Project 
    Route::group(['prefix' => '/project', 'as' => 'project'], function() {
        Route::get('/', function () {
            return view('pages.dashboard.project.index');
        });

        Route::get('/detail/', function () {
            return view('pages.dashboard.project.detail_project');
        })->name('.detail');

        Route::get('/upload/', function () {
            return view('pages.dashboard.project.upload');
        })->name('.upload');
    });
});
