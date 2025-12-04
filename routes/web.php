<?php

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

Route::get('/', [PatternController::class, 'index'])->name('home');

Route::resource('patterns', PatternController::class)->parameters([
    'patterns' => 'slug'
]);

Route::post('patterns/{slug}/sizes', [PatternSizeController::class, 'store'])->name('sizes.store');
