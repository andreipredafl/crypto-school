<?php

use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
    Route::get('/lessons/{lesson:slug}', [LessonController::class, 'show'])->name('lessons.show');

});
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
