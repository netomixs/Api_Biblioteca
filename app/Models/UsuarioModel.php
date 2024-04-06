<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class UsuarioModel extends Model
{
    public $timestamps = false;

    protected $table = 'usuarios';
    public function nivel()
    {
        return $this->belongsTo(NivelModel::class, 'Nivel', 'Id');
    }
    public function persona()
    {
        return $this->belongsTo(PersonaModel::class, 'Id_Persona', 'Id');
    }
    public function prestamo()
    {
        return $this->hasOne(PrestamoModel::class, 'Id_Lector', 'Id');
    }
}
