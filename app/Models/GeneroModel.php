<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class GeneroModel extends Model
{
    public $timestamps = false;

    protected $table = 'genero';
    public function libro()
    {
        return $this->belongsToMany(LibroModel::class, 'libroxgenero', 'Id_Genero', 'Id_Libro',"Id","Id");
    }
}
