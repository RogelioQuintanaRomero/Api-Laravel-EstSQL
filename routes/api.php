<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\studentController;


Route::get('/students',[studentController::class,'index']);
Route::post('/students',[studentController::class,'store']);
Route::get('/students/{id}',[studentController::class,'show']);
Route::delete('/students/{id}',[studentController::class,'destroy']);
Route::put('/students/{id}',[studentController::class,'update']);
Route::patch('/students/{id}',[studentController::class,'updatePartial']);

/*
    //  consulta de segmento 2 hacia controller
Route::get('/students', [studentController::class,'index']);
Route::get('/students/{id}', [studentController::class,'show']);
Route::post('/students', [studentController::class,'create']);
Route::put('/students/{id}', [studentController::class,'update']);
Route::delete('/students/{id}', [studentController::class,'delete']);
*/

/* 
//
//  1n - metodos de prueba en app inicial
//

Route::get('/students', function(){
    return 'Obtiene lista de Estudiantes desde route';
});

Route::get('/students/{id}', function(){
    return 'Obtiene Estudiante desde route';
});

Route::post('/students', function() {
    return 'Crea estudiante desde route';   
});

Route::put('/students/{id}',function(){
    return 'Actualiza estudiante desde Route';
});
Route::delete('/students/{id}',function(){
    return 'Elimina estudiante desde Route';
});

*/

/* 
//
//  1n - se comentan lineas para nuevas nuevas
//
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/