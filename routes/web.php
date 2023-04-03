<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'do_login'])->name('do_login');

Route::group(['middleware' => ['auth']], function() {

    Route::prefix('dashboard')->group(function() {
        Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');
    });

    Route::prefix('users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('user');

    });

    Route::prefix('employee')->group(function() {
        Route::get('/', [EmployeeController::class, 'index'])->name('employee');
        Route::post('/position', [EmployeeController::class, 'get_position'])->name('employee.position');
        Route::post('/store', [EmployeeController::class, 'store'])->name('employee.post');
        Route::post('/update', [EmployeeController::class, 'update'])->name('employee.update');
        Route::post('/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::post('/destroy', [EmployeeController::class, 'destroy'])->name('employee.delete');

    });

    Route::prefix('unit')->group(function() {
        Route::get('/', [UnitController::class, 'index'])->name('unit');
        Route::post('/post', [UnitController::class, 'store'])->name('unit.post');
        Route::post('/edit', [UnitController::class, 'getUnit'])->name('unit.edit');
        Route::post('/update', [UnitController::class, 'update'])->name('unit.update');
        Route::post('/delete', [UnitController::class, 'destroy'])->name('unit.delete');
    });

    Route::prefix('position')->group(function() {
        Route::get('/', [JabatanController::class, 'index'])->name('position');
        Route::post('/post', [JabatanController::class, 'store'])->name('position.post');
        Route::post('/edit', [JabatanController::class, 'getJabatan'])->name('position.edit');
        Route::post('/update', [JabatanController::class, 'update'])->name('position.update');
        Route::post('/delete', [JabatanController::class, 'destroy'])->name('position.delete');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});
