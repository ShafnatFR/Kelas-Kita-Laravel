<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kelolaUser;

Route::get('/', [kelolaUser::class, 'showUser'])->name('dashboardAdmin');

Route::post('/createUser', [kelolaUser::class, 'createUser'])->name('createUser.post');
Route::get('/createUserView', function () {
    return view('createUser');
});