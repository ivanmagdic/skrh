<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

Route::get('/cameras', [API\CameraController::class, 'index'])->name('api.cameras.index');
