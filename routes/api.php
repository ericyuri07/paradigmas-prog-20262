<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json('Minha API está online!');
});

Route::apiResource('/users', UserController::class);
Route::apiResource('/classrooms', ClassroomController::class);
Route::post('/classrooms/{id}/users', [ClassroomController::class, 'users']);
Route::apiResource('/courses', CourseController::class);