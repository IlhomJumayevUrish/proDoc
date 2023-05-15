<?php

use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('template/', [TemplateController::class, 'index'])->name('template');
});
