<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\HomeController;
use App\Models\Payment;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::apiResources([
        'users' => 'UserController',
        'patients' => 'PatientController',
        'appointments' => 'AppointmentController',
        'bills' => 'BillController',
        'debts' => 'DebtController',
        'payments' => 'PaymentController',
        'reports' => 'ReportController',
        'roles' => 'RoleController',
        'services' => 'ServiceController',
        'treatments' => 'TreatmentController',
        'visits' => 'VisitController',
    ]);
    Route::put('patient/{id}/restore',  [PatientController::class, 'restore'])->name('patient.restore');
    Route::put('patient/{id}/delete',  [PatientController::class, 'delete'])->name('patient.delete');
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
