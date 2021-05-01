<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{Apprentice};
use App\Http\Controllers\{AuthController, 
                          SubmissionController,
                          AttendanceController, 
                          ProjectController,
                          AgencyController,
                          AdminController,
                          ProfileController,
                          DashboardController,
                          AbsenController
                         };
                         
Route::get('/', function () {
    return view('pages.guest.index');
})->name('home');

Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::view('pendaftaran-magang', 'pages.guest.registration')->name('pendaftaran-magang');
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    
    // Attendence 
    Route::group(['prefix' => '/attendance', 'as' => 'attendance'], function(){
        Route::get('/', [AttendanceController::class, 'index']);
        Route::get('/detail/{id}',[AttendanceController::class, 'detail'])-> name('detail');
    });

    // Submission 
    Route::group(['prefix' => '/submission', 'as' => 'submission'],  function() {        
        Route::get('/',[SubmissionController::class, 'index']);
        Route::get('/detail/{id}',[SubmissionController::class, 'detail'])->name('.detail');
        Route::get('/detail/{id}/{agency}/reject',[SubmissionController::class, 'reject'])->name('.rejectTeam');
        Route::get('/detail/{id}/{agency}/accept',[SubmissionController::class, 'accept'])->name('.acceptTeam');
    });

    // Project 
    Route::group(['prefix' => '/project', 'as' => 'project'], function() {
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('/detail/{id}', [ProjectController::class, 'detail'])->name('.detail');
        Route::get('/detail/{teamID}/{projectID}/{progressID}', [ProjectController::class, 'detailProgress'])->name('.change');
        Route::get('/detail/{teamID}/{projectID}/{progressID}/change', [ProjectController::class, 'change'])->name('.change');
        Route::get('/detail/{teamID}/{projectID}/{progressID}/remove', [ProjectController::class, 'remove'])->name('.remove');
    });

    // Agency
    Route::group(['prefix' => '/agency', 'as' => 'agency'], function() {
        Route::get('/', [AgencyController::class, 'index']);
        Route::get('/{id}/detail', [AgencyController::class, 'detail'])->name('.detail');
        Route::get('/{id}/update', [AgencyController::class, 'update'])->name('.update');
        Route::get('/{id}/delete', [AgencyController::class, 'delete'])->name('.delete');
    });

    // Admin
    Route::group(['prefix' => '/admin', 'as' => 'admin'], function() {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/{id}/detail', [AdminController::class, 'detail'])->name('.detail');
        Route::get('/{id}/update', [AdminController::class, 'update'])->name('.update');
        Route::get('/{id}/delete', [AdminController::class, 'delete'])->name('.delete');
    });
});
