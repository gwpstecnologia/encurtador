<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/user/create/', [LinkController::class, 'create'])->name('create');
    Route::POST('/user/create/post', [LinkController::class, 'create_post'])->name('create_post');
    Route::POST('/user/show/delete', [LinkController::class, 'delete'])->name('delete');
    Route::POST('/user/show/edit', [LinkController::class, 'edit'])->name('edit');
    Route::get('/user/show/{showid?}', [LinkController::class, 'show'])->name('show');
    Route::get('/user/show/{page?}', [LinkController::class, 'show'])->name('show');
    Route::get('/user/about/', [LinkController::class, 'about'])->name('about');
});

Route::get('/{link?}', [LinkController::class, 'redirect'])->name('redirect');
