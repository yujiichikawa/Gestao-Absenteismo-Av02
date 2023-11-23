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
Route::put('/update/{cpf}', [GestorController::class, 'update']);
Route::delete('/delete/{cpf}', [GestorController::class, 'delete']);
Route::post('/{cpf_gestor}/mensagem/enviar/{cpf_colaborador}', [GestorController::class, 'enviar_mensagem']);
Route::get('/{cpf}/lista/colaboradores', [GestorController::class, 'colaboradores']);

Route::post('/{cpf}/colaborador/cadastro', [ColaboradorController::class, 'cadastro_colaborador']);
Route::put('/update/{cpf}', [ColaboradorController::class, 'update']);
Route::delete('/delete/{cpf}', [ColaboradorController::class, 'delete']);
Route::get('/{cpf}/mensagens', [ColaboradorController::class, 'mensagems']);
Route::get('/presenca/{cpf}', [ColaboradorController::class, 'presenca']);
