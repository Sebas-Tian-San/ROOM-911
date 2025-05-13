<?php

use App\Http\Controllers\AccessAttempController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Room911AccessController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeAccessHistoryController;
use App\Http\Controllers\UserController;

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
    return view('access');
});

Auth::routes();
// CRUDS 
Route::resource('departments', DepartmentController::class);
Route::resource('users', UserController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('access-attemps', AccessAttempController::class);

Route::get('/history', [App\Http\Controllers\HomeController::class, 'index'])->name('access');

// Validacion de acceso a la sala 911
Route::get('/access', [Room911AccessController::class, 'showForm'])->name('room911.form');
Route::post('/access', [Room911AccessController::class, 'processAccess'])->name('room911.process');

// Historial de acceso a la sala 911
Route::get('/employees/{employee}/history', [EmployeeAccessHistoryController::class, 'show'])->name('employees.history');
Route::get('/employees/{employee}/history/pdf', [EmployeeAccessHistoryController::class, 'exportPDF'])->name('employees.history.pdf');

// Carga masiva de empleados
Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');

//Descarga de PDF reporte de acceso
Route::get('/employees/{id}/access-history/pdf', [EmployeeController::class, 'downloadAccessHistory'])->name('employees.access-history.pdf');