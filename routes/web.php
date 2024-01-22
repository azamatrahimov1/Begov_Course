<?php

use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\Lesson_1Controller;
use App\Http\Controllers\Admin\Lesson_2Controller;
use App\Http\Controllers\Admin\MainScreenController;
use App\Http\Controllers\Admin\PreIELTSController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', '\App\Http\Controllers\HomeController@index')->name('index');
Route::get('/home/{chapter?}', [\App\Http\Controllers\HomeController::class, 'index'])->name('chapters');

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [ChapterController::class, 'index'])->name('chapters.index');

    Route::get('/404', [ChapterController::class, 'index']);

    Route::resource('/chapters', ChapterController::class);

    Route::resource('/main-screen', MainScreenController::class)->middleware('role:super-user');

    Route::resource('/contacts', ContactController::class)->middleware('can:show');

    //About
    Route::get('/abouts', [AboutController::class, 'index'])->name('abouts.index');
    Route::post('/abouts/store', [AboutController::class, 'store'])->name('abouts.store');
    Route::get('/abouts/{about}/edit', [AboutController::class, 'edit'])->name('abouts.edit');
    Route::put('/abouts/{about}', [AboutController::class, 'update'])->name('abouts.update');
    Route::delete('/abouts/{about}', [AboutController::class, 'destroy'])->name('abouts.delete');

    //Users
    Route::get('/pre-IELTS', [PreIELTSController::class, 'index'])->name('pre-IELTS.index')->middleware('can:show_pre_IELTS');
    Route::get('/pre-IELTS/create', [PreIELTSController::class, 'create'])->name('pre-IELTS.create')->middleware('can:create');
    Route::post('/pre-IELTS/store', [PreIELTSController::class, 'store'])->name('pre-IELTS.store')->middleware('can:create');
    Route::get('/pre-IELTS/{pre_IELT}/edit', [PreIELTSController::class, 'edit'])->name('pre-IELTS.edit')->middleware('can:edit');
    Route::put('/pre-IELTS/{pre_IELT}', [PreIELTSController::class, 'update'])->name('pre-IELTS.update')->middleware('can:edit');
    Route::get('/pre-IELTS/{pre_IELT}', [PreIELTSController::class, 'show'])->name('pre-IELTS.show')->middleware('can:show');
    Route::delete('/pre-IELTS/{pre_IELT}', [PreIELTSController::class, 'destroy'])->name('pre-IELTS.delete')->middleware('can:delete');


    Route::resource('/role', RoleController::class)->middleware('role:super-user');
    //Users
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index')->middleware('role:super-user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('can:create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('can:create');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('can:edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update')->middleware('can:edit');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete')->middleware('can:delete');

    //Lesson 1
    Route::get('/lesson-1', [Lesson_1Controller::class, 'index'])->name('lesson-1.index')->middleware('can:show-grammar-lessons');
    Route::post('/lesson-1/store', [Lesson_1Controller::class, 'store'])->name('lesson-1.store')->middleware('can:create');
    Route::get('/lesson-1/{lesson_1}/edit', [Lesson_1Controller::class, 'edit'])->name('lesson-1.edit')->middleware('can:edit');
    Route::put('/lesson-1/{lesson_1}', [Lesson_1Controller::class, 'update'])->name('lesson-1.update')->middleware('can:edit');
    Route::delete('/lesson-1/{lesson_1}', [Lesson_1Controller::class, 'delete'])->name('lesson-1.delete')->middleware('can:delete');

    //Lesson 1
    Route::get('/lesson-2', [Lesson_2Controller::class, 'index'])->name('lesson-2.index')->middleware('can:show-grammar-lessons');
    Route::post('/lesson-2/store', [Lesson_2Controller::class, 'store'])->name('lesson-2.store')->middleware('can:create');
    Route::get('/lesson-2/{lesson_2}/edit', [Lesson_2Controller::class, 'edit'])->name('lesson-2.edit')->middleware('can:edit');
    Route::put('/lesson-2/{lesson_2}', [Lesson_2Controller::class, 'update'])->name('lesson-2.update')->middleware('can:edit');
    Route::delete('/lesson-2/{lesson_2}', [Lesson_2Controller::class, 'delete'])->name('lesson-2.delete')->middleware('can:delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
