<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatternController;
use App\Http\Controllers\PatternSizeController;
use App\Http\Controllers\CategoryController;


Route::get('/', [PatternController::class, 'index'])->name('home');

Route::resource('patterns', PatternController::class)->parameters([
    'patterns' => 'slug'
]);

Route::post('patterns/{slug}/sizes', [PatternSizeController::class, 'store'])->name('sizes.store');

Route::resource('categories', CategoryController::class)->except(['edit', 'update', 'show']);