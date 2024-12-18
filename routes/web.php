<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');


Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{movieId}', [CommentController::class, 'getCommentsForMovie'])
    ->name('comments.getCommentsForMovie');
