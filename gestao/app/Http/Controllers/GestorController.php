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

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $gestor = Gestor::find($id);

        $gestor->nome = $data->nome;
        $gestor->cpf = $data->cpf;
        $gestor->atuacao = $data->atuacao;
        $gestor->save();

        $contato = Contato::find($gestor->contato_id);
        $contato->telefone = $data->contato->telefone;
        $contato->email = $data->contato->email;
        $contato->save();

        $endereco = Endereco::find($gestor->endereco_id);
        $endereco->cidade = $data->endereco->cidade;
        $endereco->bairro = $data->endereco->bairro;
        $endereco->rua = $data->endereco->rua;
        $endereco->moradia = $data->endereco->moradia;
        $endereco->numero = $data->endereco->numero;
        $endereco->save();

        //Flight::where('active', 1)
        //    ->where('destination', 'San Diego')
        //    ->update(['delayed' => 1]);

        //$contato = [
        //    'telefone' => $request->input("contato.telefone"),
        //    'email' => $request->input("contato.email"),
        //];

        //Contato::where('id',$gestor->contato_id)->update($contato);
        //$contato = DB::select('select * from contatos where active = ?', [$gestor->contato_id]);
        //$contato->telefone = $request->input("contato.telefone");
        //$contato->email = $request->input("contato.email");

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
