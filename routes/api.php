<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::resource('estudiantes',App\Http\Controllers\estudiantesController::class);
route::resource('grupos',App\Http\controllers\gruposController::class);
route::resource('materias',App\Http\controllers\materiasController::class);
route::resource('notas',App\Http\controllers\notasController::class);
