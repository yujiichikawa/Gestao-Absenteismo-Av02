<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Comunicado;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Gestor;
use DateTime;
use Illuminate\Http\Request;

class GestorController extends Controller
{

    public function cadastro_gestor(Request $request)
    {
        $existente = false;
        $gestores = Gestor::all();
        foreach ($gestores as $gestor) {
            if($gestor->cpf == $request->cpf){
                $existente = true;
                echo 'Gestor já existente';
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


            $gestor = new Gestor;
            $gestor->nome = $request->nome;
            $gestor->cpf = $request->cpf;
            $gestor->atuacao = $request->atuacao;
            $gestor->endereco_id = $endereco->id;
            $gestor->contato_id = $contato->id;
            $gestor->save();

            return $request;
        }

    }

    public function update($id,Request $request)
    {

        $gestor = Gestor::find($id);
        if(is_null($gestor)){
            echo 'Gestor não existente';
        }else{

            if($gestor->cpf != $request->cpf){
                echo "cpf não pode ser alterado";
            }else{

                $gestor->nome = $request->nome;
                $gestor->cpf = $request->cpf;
                $gestor->atuacao = $request->atuacao;
                $gestor->save();

                $contato = Contato::find($gestor->contato_id);
                $contato->telefone = $request->input("contato.telefone");
                $contato->email = $request->input("contato.email");
                $contato->save();

                $endereco = Endereco::find($gestor->endereco_id);
                $endereco->cidade = $request->input("endereco.cidade");
                $endereco->bairro = $request->input("endereco.bairro");
                $endereco->rua = $request->input("endereco.rua");
                $endereco->moradia = $request->input("endereco.moradia");
                $endereco->numero = $request->input("endereco.numero");
                $endereco->save();
                echo 'Atualizado com sucesso';
            }

        }

    }
    public function delete($id)
    {
        $gestor = Gestor::find($id);
        if(is_null($gestor)){
            echo 'Gestor não existente';
        }else{
            $gestor->delete();
            $contato = Contato::find($gestor->contato_id)->delete();
            $endereco = Endereco::find($gestor->endereco_id)->delete();
            echo 'Gestor foi excluido com sucesso';
        }
    }
    public function enviar_mensagem($id_gestor, $id_colaborador,Request $request)
    {
        $gestor = Gestor::find($id_gestor);
        if(is_null($gestor)){
            echo 'Gestor não existente';
        }else{
            $colaborador = Colaborador::find($id_colaborador);
            if(is_null($colaborador)){
                echo 'Colaborador não existente';
            }else{
                $comunicado = new Comunicado;
                $comunicado->tipo_comunicado = $request->input("tipo_comunicado");
                $comunicado->mensagem = $request->input("mensagem");
                $comunicado->data_envio = new DateTime('now');
                $comunicado->gestor_id = $gestor->id;
                $comunicado->colaborador_id = $colaborador->id;
                $comunicado->save();
                echo 'Comunicado enviado com sucesso';
            }
        }
    }
    public function colaboradores($id)
    {
        $gestor = Gestor::find($id);
        $colaboradores = Colaborador::all();
        $colaborador_gestor = [];

        if(is_null($gestor)){
            echo 'Gestor não existente';
        }else{
            foreach ($colaboradores as $colaborador) {
                if($colaborador->gestor_id == $gestor->id){
                    $contato = Contato::find($colaborador->id);
                    $object_edit = (object) [
                        'nome' => $colaborador->nome,
                        'cpf' => $colaborador->cpf,
                        'atuacao' => $colaborador->atuacao,
                        'email' => $contato->email,
                        'telefone' => $contato->telefone,
                    ];

                    array_push($colaborador_gestor,$object_edit);
                }
            }

            if(empty($colaborador_gestor)){
                echo 'Não há colaboradores';
            }else{
                return $colaborador_gestor;
            }
        }
    }
}
