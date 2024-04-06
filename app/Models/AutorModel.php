<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class AutorModel extends Model
{
    public $timestamps = false;
    protected $table = 'autor';
    public function persona()
    {
        return $this->belongsTo(PersonaModel::class, 'Id_Persona', "Id");
    }
    public function libro()
    {
        return $this->belongsToMany(LibroModel::class, 'libroxautor', 'Id_Autor', 'Id_Libro',"Id","Id");
    }
}
