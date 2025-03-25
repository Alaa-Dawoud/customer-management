<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfNotEmployee;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\CustomerController;



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

Route::group(['middleware' => [RedirectIfNotEmployee::class]], function () {
    Route::get('/', [DashboardController::class , 'index'])->name('dashboard');
    Route::resource('customers', CustomerController::class);
    Route::put('/customers/{customer}/action', [CustomerController::class, 'updateAction'])->name('customers.updateAction');

});


require __DIR__ . '/employee_auth.php';
