<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kelolaUser;

// Index/Show All
Route::get('/', [kelolaUser::class, 'showUser'])->name('user.index');

// CREATE User
Route::get('/user/createView', [kelolaUser::class, 'createUserView'])->name('user.createView');
Route::post('/user/store', [kelolaUser::class, 'storeUser'])->name('user.store');

// EDIT User
Route::get('/user/{id}/editView', [kelolaUser::class, 'editUserView',])->name('user.editView');
Route::post('/user/{id}/edit', [kelolaUser::class, 'editUser'])->name('user.edit');

// DELETE User
Route::get('/user/{id}/deleteView', [kelolaUser::class, 'deleteUserView'])->name('user.deleteView');
Route::post('/user/{id}/delete', [kelolaUser::class, 'deleteUser'])->name('user.delete');