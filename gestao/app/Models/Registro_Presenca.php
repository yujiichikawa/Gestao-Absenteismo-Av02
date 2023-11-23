<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro_Presenca extends Model
{
    use HasFactory;

    public function colaborador()
    {
        return $this->hasOne(Colaborador::class);
    }
}
