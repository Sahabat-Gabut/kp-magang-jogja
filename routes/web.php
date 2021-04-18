<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, SubmissionController,AttendanceController, ProjectController};
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
    Route::view('pendaftaran-magang', 'pages.guest.registration')->name('pendaftaran-magang');
    
    Route::get('dashboard',function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

    Route::get('profile',function () {
        return view('pages.dashboard.profile.index');
    })->name('profile');
    
    // Attendence 
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance');

    // Submission 
    Route::group(['prefix' => '/submission', 'as' => 'submission'],  function() {        
        Route::get('/',[SubmissionController::class, 'index']);
        Route::get('/detail/{id}',[SubmissionController::class, 'detail'])->name('.detail');
        Route::get('/detail/{id}/reject',[SubmissionController::class, 'reject'])->name('.rejectTeam');
        Route::get('/detail/{id}/accept',[SubmissionController::class, 'accept'])->name('.acceptTeam');
    });

    // Project 
    Route::group(['prefix' => '/project', 'as' => 'project'], function() {
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('/detail/{id}', [ProjectController::class, 'detail'])->name('.detail');
        Route::get('/detail/{projectID}/{progressID}/change', [ProjectController::class, 'change'])->name('.change');
        Route::get('/detail/{projectID}/{progressID}/remove', [ProjectController::class, 'remove'])->name('.remove');
    });
});
