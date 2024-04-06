<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


 class NivelModel extends Model{
    public $timestamps = false;

    protected $table = 'nivel';
    public function Usuario()
    {
        return $this->hasOne(UsuarioModel::class, 'Nivel','Id');
    }
}