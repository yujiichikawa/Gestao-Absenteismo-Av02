<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\ColaboradorController;
use App\Models\Gestor;

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
Route::put('/gestor/atualizar/{id}', [GestorController::class, 'update']);
Route::delete('/gestor/deletar/{id}', [GestorController::class, 'delete']);
Route::post('/{id_gestor}/mensagem/enviar/{id_colaborador}', [GestorController::class, 'enviar_mensagem']);
Route::get('/{id}/lista/colaboradores', [GestorController::class, 'colaboradores']);

Route::post('/{id_gestor}/colaborador/cadastro', [ColaboradorController::class, 'cadastro_colaborador']);
Route::put('/colaborador/atualizar/{id}', [ColaboradorController::class, 'update']);
Route::delete('/colaborador/deletar/{id}', [ColaboradorController::class, 'delete']);
Route::get('/{id}/mensagens', [ColaboradorController::class, 'mensagems']);
Route::get('/presenca/{id}', [ColaboradorController::class, 'presenca']);
