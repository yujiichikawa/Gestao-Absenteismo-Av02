<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;
    protected $fillable = ['nome','cpf','atuacao'];
    
    public function contato()
    {
        return $this->hasOne(Contato::class);
    }
    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
    public function comunicados()
    {
        return $this->belongsTo(Comunicado::class);
    }
    public function registro_presencas()
    {
        return $this->belongsTo(Registro_Presenca::class);
    }
    public function gestor()
    {
        return $this->hasOne(Gestor::class);
    }
}
