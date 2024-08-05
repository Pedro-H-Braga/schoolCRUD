<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolClasses;
use App\Http\Controllers\Students;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('students', Students::class);
Route::apiResource('classes', SchoolClasses::class); 
Route::get('classes/students/{id}', [SchoolClasses::class, 'studentsClass']);

