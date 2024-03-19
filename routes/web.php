<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomUserController;
use App\Http\Controllers\SoftDeleteController;

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/users', [App\Http\Controllers\CustomUserController::class, 'index'])->name('users.index');
// Route::get('/create', [App\Http\Controllers\CustomUserController::class, 'create'])->name('users.create');
// Route::post('/store', [App\Http\Controllers\CustomUserController::class, 'store'])->name('users.store');
// Route::get('/show', [App\Http\Controllers\CustomUserController::class, 'show'])->name('users.show');
// Route::get('/edit', [App\Http\Controllers\CustomUserController::class, 'edit'])->name('users.edit');
// Route::post('/update', [App\Http\Controllers\CustomUserController::class, 'update'])->name('users.update');
// Route::post('/edit', [App\Http\Controllers\CustomUserController::class, 'destroy'])->name('users.destroy');



Route::middleware('auth')->group(function () {
    Route::resource('customuser', CustomUserController::class);
     Route::put('restore/{id}', [SoftDeleteController::class, 'restore'])->name('restore');
    
     Route::get('deleted', [CustomUserController::class, 'softdeleteindex'])->name('deleted');
      
    Route::delete('destroy/{id}', [SoftDeleteController::class, 'destroyPermanently'])->name('destroy-permanently');
    

   
  
    // Additional routes for soft-deleted users
 
});

