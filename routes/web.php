<?php

use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LessonLikeController;
use App\Http\Controllers\Admin\MainScreenController;
use App\Http\Controllers\Admin\OfflineController;
use App\Http\Controllers\Admin\PreIELTSController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\OnlineController;
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


Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth')->group(function () {
    //Main Screen
    Route::resource('/main-screen', MainScreenController::class)->middleware('role:super-user');
    //Contact
    Route::resource('/contacts', ContactController::class)->middleware('can:show-message');
    //About
    Route::resource('/abouts', AboutController::class)->middleware('role:super-user');
    //Type of Lessons
    Route::resource('/online', OnlineController::class)->middleware('role:super-user');
    Route::resource('/offline', OfflineController::class)->middleware('role:super-user');
    //Role
    Route::resource('/role', RoleController::class)->middleware('role:super-user');
    //Users
    Route::resource('/users', UserController::class)->middleware('role:super-user');

    //Lessons
    Route::get('/dashboard', [LessonController::class, 'index'])->name('lessons.index')->middleware('can:show-grammar-lessons');
    Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show')->middleware('can:show-grammar-lessons');
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store')->middleware('can:create');
    Route::get('/lessons{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit')->middleware('can:edit');
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update')->middleware('can:edit');
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy')->middleware('can:delete');
    Route::post('like/{lesson}/like', [LessonController::class, 'like'])->name('lessons.like');
    Route::post('like/{lesson}/unlike', [LessonController::class, 'unlike'])->name('lessons.unlike');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('can:show-grammar-lessons');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('can:show-grammar-lessons');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('can:show-grammar-lessons');

});

require __DIR__.'/auth.php';
