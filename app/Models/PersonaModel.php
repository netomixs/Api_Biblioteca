<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


 class PersonaModel extends Model{
    public $timestamps = false;

    protected $table = 'personas';
    public function autor()
    {
        return $this->hasOne(AutorModel::class, 'Id_Persona','Id');
    }
    public function usuario()
    {
        return $this->hasOne(UsuarioModel::class, 'Id_Persona','Id');
    }
}