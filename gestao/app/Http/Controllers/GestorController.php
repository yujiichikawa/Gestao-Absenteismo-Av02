<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Gestor;
use Illuminate\Http\Request;

class GestorController extends Controller
{

    public function cadastro_gestor(Request $request)
    {
        //dd($request->all());

        $contato = new Contato;
        $contato->telefone = $request->input("contato.telefone");
        $contato->email = $request->input("contato.email");

        $contato->save();

        $endereco = new Endereco;
        $endereco->cidade = $request->input("endereco.cidade");
        $endereco->bairro = $request->input("endereco.bairro");
        $endereco->rua = $request->input("endereco.rua");
        $endereco->moradia = $request->input("endereco.moradia");
        $endereco->numero = $request->input("endereco.numero");

        $endereco->save();

        $gestor = new Gestor;
        $gestor->nome = $request->nome;
        $gestor->cpf = $request->cpf;
        $gestor->atuacao = $request->atuacao;
        $gestor->endereco_id = $endereco->id;
        $gestor->contato_id = $contato->id;

        $gestor->save();
    }

    public function cadastro_endereco(Request $request){

    }
    public function update(Request $request, $cpf)
    {

    }
    public function delete($cpf)
    {

    }
    public function enviar_mensagem($cpf_gestor, $cpf_colaborador)
    {

    }
    public function colaboradores($cpf)
    {

    }
}
