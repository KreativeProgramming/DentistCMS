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


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
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
    Route::put('appointment/{id}/restore',  [AppointmentController::class, 'restore'])->name('appointment.restore');
    Route::put('appointment/{id}/delete',  [AppointmentController::class, 'delete'])->name('appointment.delete');
    Route::put('role/{id}/restore',  [RoleController::class, 'restore'])->name('role.restore');
    Route::put('role/{id}/delete',  [RoleController::class, 'delete'])->name('role.delete');
    Route::put('treatment/{id}/restore',  [TreatmentController::class, 'restore'])->name('treatment.restore');
    Route::put('treatment/{id}/delete',  [TreatmentController::class, 'delete'])->name('treatment.delete');
    Route::put('notification/{id}/markAsRead', [HomeController::class, 'markAsRead'])->name('notification.markAsRead');
});
