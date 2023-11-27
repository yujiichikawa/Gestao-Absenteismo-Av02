<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Gestor;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function cadastro_colaborador(Request $request, $id_gestor)
    {

        $gestor = Gestor::find($id_gestor);
        if(is_null($gestor)){
            echo 'Gestor não existente';
        }else{
            $existente = false;
            $colaboradores = Colaborador::all();
            foreach ($colaboradores as $colaborador) {
                if($colaborador->cpf == $request->cpf){
                    $existente = true;
                    echo 'Colaborador já existente';
                }
            }

            if(!$existente){
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


                $colaborador = new Colaborador;
                $colaborador->nome = $request->nome;
                $colaborador->cpf = $request->cpf;
                $colaborador->atuacao = $request->atuacao;
                $colaborador->endereco_id = $endereco->id;
                $colaborador->contato_id = $contato->id;
                $colaborador->gestor_id = $gestor->id;
                $colaborador->save();

                echo 'Cadastrado com sucesso';
            }
        }

    }
    public function update(Request $request, $cpf)
    {

    }
    public function delete($cpf)
    {

    }
    public function mensagems($cpf)
    {

    }
    public function presenca($cpf)
    {

    }


}
