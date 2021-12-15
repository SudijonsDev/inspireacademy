<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentreController;

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
    return view('welcome');
});

// route to list centres
Route::get('centres', [CentreController::class, 'index'])->name('centres');

// add centre
Route::get('centre/add', [CentreController::class, 'add'])->name('addCentre');

// store user
Route::post('centre/store', [CentreController::class, 'store'])->name('storeCentre');

// edit user
Route::get('centre/edit/{id}', [CentreController::class, 'edit'])->name('editCentre');

// update user
Route::PATCH('centre/update/{id}', [CentreController::class, 'update'])->name('updateCentre');
