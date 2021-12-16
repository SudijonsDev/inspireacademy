<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\UserController;

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

// show the login form
Route::get('login', [UserController::class, 'showLogin'])->name('login');

// process the login form
Route::post('login', array(UserController::class, 'doLogin'))->name('login');

// add user
Route::get('user/add', [UserController::class, 'add'])->name('addUser');

// store user
Route::post('user/store', [UserController::class, 'store'])->name('storeUser');

// process the logout
Route::get('users/logout', [UserController::class, 'doLogout'])->name('logout');

// route to list centres
Route::get('centres', [CentreController::class, 'index'])->name('centres');

// add centre
Route::get('centre/add', [CentreController::class, 'add'])->name('addCentre');

// store centre
Route::post('centre/store', [CentreController::class, 'store'])->name('storeCentre');

// edit centre
Route::get('centre/edit/{id}', [CentreController::class, 'edit'])->name('editCentre');

// update centre
Route::PATCH('centre/update/{id}', [CentreController::class, 'update'])->name('updateCentre');

// route to list learners
Route::get('learners', [LearnerController::class, 'index'])->name('learners');

// add learner
Route::get('learner/add', [LearnerController::class, 'add'])->name('addLearner');

// store learner
Route::post('learner/store', [LearnerController::class, 'store'])->name('storeLearner');

// edit learner
Route::get('learner/edit/{id}', [LearnerController::class, 'edit'])->name('editLearner');

// update learner
Route::PATCH('learner/update/{id}', [LearnerController::class, 'update'])->name('updateLearner');
