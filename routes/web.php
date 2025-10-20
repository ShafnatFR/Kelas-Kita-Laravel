<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kelolaUser;

Route::get('/', [kelolaUser::class, 'showUser'])->name('dashboardAdmin');
