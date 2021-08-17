<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgressProjectController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ValuationController;
use App\Http\Resources\JSSResource;
use App\Models\JSS;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('login', [SessionController::class, 'create'])->name('login');
Route::post('login', [SessionController::class, 'store']);
Route::post('logout', [SessionController::class, 'destroy'])->name('logout');

Route::group(['middleware' => ['auth']], function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Attendance
    Route::resource('attendance', AttendanceController::class)->except('show');
    Route::get('attendance/{team}', [AttendanceController::class, 'show'])->name('attendaceshow');

    // Admin
    Route::resource('admin', AdminController::class)->except('create');

    // Agency
    Route::resource('agency', AgencyController::class);

    // Project
    Route::resource('project', ProjectController::class)->except('create');

    // Progress Project
    Route::post('/progress', [ProgressProjectController::class, 'store'])->name('progress.store');
    Route::get('/project/progress/{progressProject}', [ProgressProjectController::class, 'show'])->name('progress.show');
    Route::put('/progress/{progressProject}', [ProgressProjectController::class, 'update'])->name('progress.update');
    Route::delete('/progress/{progressProject}', [ProgressProjectController::class, 'destroy'])->name('progress.destroy');

    // Valuation Progress Project
    Route::post('/valuation', [ValuationController::class, 'store'])->name('valuation.store');
    Route::put('/valuation/{valuation}', [ValuationController::class, 'update'])->name('valuation.update');

    // Submission
    Route::resource('submission', SubmissionController::class)->except(['edit', 'update', 'destroy', 'show']);
    Route::get('submission/{team}', [SubmissionController::class, 'show'])->name('submission.show');
    Route::put('submission/{team}/{status}', [SubmissionController::class, 'update'])->name('submission.update');

    Route::get('/getJSS/{id}', function ($id) {
        return new JSSResource(JSS::findOrFail($id));
    });
});
