<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\CustomerController;



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

Route::group(['middleware' => [RedirectIfNotAdmin::class]], function () {
    Route::get('/', [DashboardController::class , 'index'])->name('dashboard');
    Route::resource('admins', AdminsController::class)->except('create', 'show');
    Route::resource('employees', EmployeeController::class);
    Route::resource('customers', CustomerController::class);
    Route::put('/employees/{employee}/assign-customers', 
    [EmployeeController::class, 'assignCustomersToEmployee'])->name('employees.assign-customers');
});


require __DIR__ . '/admin_auth.php';
