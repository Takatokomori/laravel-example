<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\StudentController;

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

Route::get('/', function () {
    // return view('welcome');
    return view('top');
})->name("top");

// Blog
Route::resource("blogs", BlogController::class)
    ->only(["index", "store", "show",
            "edit","update", "destroy"]);

// Student
Route::resource("students", StudentController::class)
->only(["index", "store", "show",
        "edit","update", "destroy"]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class,
        'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,
        'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,
        'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
