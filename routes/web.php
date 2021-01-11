<?php

use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\HomeController;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('pacient', PacientController::class);
    Route::resource('appointment', AppointmentController::class);
    Route::resource('bill', BillController::class);
    Route::resource('debt', DebtController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('report', ReportController::class);
    Route::resource('role', RoleController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('treatment', TreatmentController::class);
    Route::resource('visit', VisitController::class);
    Route::put('pacient/{id}/restore',  [PacientController::class, 'restore'])->name('pacient.restore');
    Route::put('pacient/{id}/delete',  [PacientController::class, 'delete'])->name('pacient.delete');
    Route::put('user/{id}/restore',  [UserController::class, 'restore'])->name('user.restore');
    Route::put('user/{id}/delete',  [UserController::class, 'delete'])->name('user.delete');
});
