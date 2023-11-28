<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Comunicado;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Gestor;
use App\Models\Registro_Presenca;
use DateTime;
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

                return $request;
            }
        }

    }
    public function update($id, Request $request)
    {
        
        $colaborador = Colaborador::find($id);
        if(is_null($colaborador)){
            echo 'colaborador não existente';
        }else{

            if($colaborador->cpf != $request->cpf){
                echo "cpf não pode ser alterado";
            }else{

                $colaborador->nome = $request->nome;
                $colaborador->cpf = $request->cpf;
                $colaborador->atuacao = $request->atuacao;
                $colaborador->save();

                $contato = Contato::find($colaborador->contato_id);
                $contato->telefone = $request->input("contato.telefone");
                $contato->email = $request->input("contato.email");
                $contato->save();

                $endereco = Endereco::find($colaborador->endereco_id);
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
        $colaborador = Colaborador::find($id);
        if(is_null($colaborador)){
            echo 'Colaborador não existente';
        }else{
            $colaborador->delete();
            $contato = Contato::find($colaborador->contato_id)->delete();
            $endereco = Endereco::find($colaborador->endereco_id)->delete();
            echo 'Colaborador foi excluido com sucesso';
        }
    }
    public function mensagems($id)
    {
        $colaborador = Colaborador::find($id);
        $comunicados = Comunicado::all();
        $colaborador_comunicado = [];

        if(is_null($colaborador)){
            echo 'Colaborador não existente';
        }else{
            foreach ($comunicados as $comunicado) {
                if($comunicado->colaborador_id == $colaborador->id){
                    $object_edit = (object) [
                        'tipo_comunicado' => $comunicado->tipo_comunicado,
                        'mensagem' => $comunicado->mensagem,
                    ];

                    array_push($colaborador_comunicado,$object_edit);
                }
            }

            if(empty($colaborador_comunicado)){
                echo 'Não há comunicados';
            }else{
                return $colaborador_comunicado;
            }
        }
    }
    public function presenca($id)
    {
        $colaborador = Colaborador::find($id);
        if(is_null($colaborador)){
            echo 'Colaborador não existente';
        }else{
            $presenca = new Registro_Presenca;
            $presenca->hora_chegada = new DateTime('now');
            $presenca->colaborador_id = $colaborador->id;
            $presenca->save();
        }


    }


}
