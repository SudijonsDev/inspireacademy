<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegisteredCourseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ReportController;

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

// route to list users
Route::get('users', [UserController::class, 'index'])->name('users');

// add user
Route::get('user/add', [UserController::class, 'add'])->name('addUser');

// store user
Route::post('user/store', [UserController::class, 'store'])->name('storeUser');

// edit user
Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('editUser');

// update user
Route::PATCH('user/update/{id}', [UserController::class, 'update'])->name('updateUser');

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

// route to list subjects
Route::get('subjects', [SubjectController::class, 'index'])->name('subjects');

// add subject
Route::get('subject/add', [SubjectController::class, 'add'])->name('addSubject');

// store subject
Route::post('subject/store', [SubjectController::class, 'store'])->name('storeSubject');

// edit subject
Route::get('subject/edit/{id}', [SubjectController::class, 'edit'])->name('editSubject');

// update subject
Route::PATCH('subject/update/{id}', [SubjectController::class, 'update'])->name('updateSubject');

// route to list courses
Route::get('courses', [CourseController::class, 'index'])->name('courses');

// add course
Route::get('course/add', [CourseController::class, 'add'])->name('addCourse');

// store course
Route::post('course/store', [CourseController::class, 'store'])->name('storeCourse');

// edit subject
Route::get('course/edit/{id}', [CourseController::class, 'edit'])->name('editCourse');

// update subject
Route::PATCH('course/update/{id}', [CourseController::class, 'update'])->name('updateCourse');

// route to list registered courses
Route::get('regcourses', [RegisteredCourseController::class, 'index'])->name('registeredCourses');

// create a register
Route::get('regcourse/create', [RegisteredCourseController::class, 'create'])->name('registerLearner');

// store register
Route::post('regcourse/store', [RegisteredCourseController::class, 'store'])->name('storeRegister');

// deregister course
Route::get('regcourse/destroy/{id}', [RegisteredCourseController::class, 'destroy'])->name('deRegister');

// register session
Route::get('session/add/{id}', [SessionController::class, 'add'])->name('addSession');

// store session
Route::post('session/store', [SessionController::class, 'store'])->name('storeSession');

// route to list sessions per week
Route::get('session/weeklyReport', [SessionController::class, 'weekSession'])->name('weekSession');

// route to list created courses per subject
Route::get('reports/subAndCourses', [ReportController::class, 'coursesPerSubject'])->name('coursesPerSubject');

// route to search learners per selected course and centre
Route::get('reports/learnerCentCour', [ReportController::class, 'searchLearnersCentreCourse'])->name('courseCentre');

// route to list learners per select course and centre
Route::get('reports/learnerCentCourRep', [ReportController::class, 'learnersCentreCourseRep'])->name('courseCentreRep');

// route to search learners per selected course
Route::get('reports/learnersPerCourse', [ReportController::class, 'searchLearnersPerCourse'])->name('learnersPerCourse');

// route to list learners per selected course
Route::get('reports/learnersCourseRep', [ReportController::class, 'learnersPerCourseRep'])->name('learnersCourseRep');

// route to search learners performance across course or across year
Route::get('report/learnersPerformance', [ReportController::class, 'learnersPerformance'])->name('learnersPerformance');

// route to list learners performance across course or across year
Route::get('report/learnersPerformanceRep', [ReportController::class, 'learnersPerformanceRep'])->name('learnersPerformRep');


