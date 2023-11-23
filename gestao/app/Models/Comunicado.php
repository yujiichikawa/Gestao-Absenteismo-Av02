<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    use HasFactory;

    public function gestor()
    {
        return $this->hasOne(Gestor::class);
    }
    public function colaborador()
    {
        return $this->hasOne(Colaborador::class);
    }
}
