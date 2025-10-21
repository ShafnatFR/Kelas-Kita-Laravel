<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kelolaUser;

Route::get('/', [kelolaUser::class, 'showUser']);

Route::get('/user/{id}/editView', [kelolaUser::class, 'editUserView',])->name('user.editView');

Route::post('/user/{id}/edit', [kelolaUser::class, 'editUser'])->name('user.edit');

Route::get('/user/{id}/deleteView', [kelolaUser::class, 'deleteUserView'])->name('user.delete');