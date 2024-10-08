<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

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
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login_form'])->name('login.form');
Route::get('/login-proses', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register_form'])->name('register.form');
Route::get('/register-proses', [AuthController::class, 'register'])->name('register');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/limbah', [MasterDataController::class, 'index_limbah'])->name('limbah');
Route::post('limbah/add', [MasterDataController::class, 'addlimbah'])->name('limbah.add');
Route::put('/limbah/update/{id}', [MasterDataController::class, 'updatelimbah'])->name('limbah.update');
Route::delete('/limbah/delete/{id}', [MasterDataController::class, 'deletelimbah'])->name('limbah.delete');
Route::get('/api/limbah', [MasterDataController::class, 'getLimbah']);

Route::get('/destination', [MasterDataController::class, 'index_destination'])->name('destination');
Route::post('/destination/add', [MasterDataController::class, 'adddestination'])->name('destination.add');
Route::put('/destination/update/{id}', [MasterDataController::class, 'updatedestination'])->name('destination.update');
Route::delete('/destination/delete/{id}', [MasterDataController::class, 'deletedestination'])->name('destination.delete');

Route::get('/report', [ReportController::class, 'index'])->name('report');
Route::post('/report/add', [ReportController::class, 'store'])->name('report.store');
Route::get('/report/detail/{id}', [ReportController::class, 'show'])->name('report.show');
Route::put('/report/detail/update/{id}', [ReportController::class, 'updatedetail']);
Route::delete('/report/detail/delete/{id}', [ReportController::class, 'destroydetail']);
Route::put('/report/update/{id}', [ReportController::class, 'updateDetail'])->name('report.update');
Route::delete('/report/delete/{id}', [ReportController::class, 'deleteReport'])->name('report.delete');

Route::get('/approval', [ApprovalController::class, 'index'])->name('approval');
