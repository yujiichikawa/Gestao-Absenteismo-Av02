<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\ColaboradorController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/cadastro', [GestorController::class, 'cadastro_gestor']);
Route::put('/update/{id}', [GestorController::class, 'update']);
Route::delete('/delete/{id}', [GestorController::class, 'delete']);
Route::post('/{id_gestor}/mensagem/enviar/{id_colaborador}', [GestorController::class, 'enviar_mensagem']);
Route::get('/{id}/lista/colaboradores', [GestorController::class, 'colaboradores']);

Route::post('/{id}/colaborador/cadastro', [ColaboradorController::class, 'cadastro_colaborador']);
Route::put('/update/{id}', [ColaboradorController::class, 'update']);
Route::delete('/delete/{id}', [ColaboradorController::class, 'delete']);
Route::get('/{id}/mensagens', [ColaboradorController::class, 'mensagems']);
Route::get('/presenca/{id}', [ColaboradorController::class, 'presenca']);
