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
// Route::post('classes/create', [SchoolClasses::class, 'store']); 


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * Para listar os alunos de uma turma:
 */
// Route::prefix('students/{studentId}')->group(function () {
//     Route::get('school-classes', [Students::class, 'schoolClasses']);
// });

/**
 * Protegendo rotas resource de acesso
 */
    /**
     * index  | get all
     * create | get $id
     * store  | post $request/$model/$id
     * edit   | get $id
     * update | patch $request/$model/$id
     * delete | delete?patch $id
     */
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('students', Students::class);
//     Route::apiResource('school-classes', SchoolClasses::class);    
// });

// Route::get('/students', [Students::class, 'index']);
