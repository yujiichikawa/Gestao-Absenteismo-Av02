<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    use HasFactory;

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
    public function colaboradores()
    {
        return $this->belongsTo(Colaborador::class);
    }
}
