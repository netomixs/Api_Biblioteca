<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class LibroModel extends Model
{
    public $timestamps = false;

    protected $table = 'libro';
    public function genero()
    {
        return $this->belongsToMany(GeneroModel::class, 'libroxgenero', 'Id_Libro', 'Id_Genero', "Id", "Id");
    }
    public function generoInsert()
    {
        return $this->belongsToMany(GeneroModel::class, 'libroxgenero', 'Id_Libro', 'Id_Genero');
    }
    public function autor()
    {
        return $this->belongsToMany(AutorModel::class, 'libroxautor', 'Id_Libro', 'Id_Autor', "Id", "Id");
    }
    public function autorInsert()
    {
        return $this->belongsToMany(AutorModel::class, 'libroxautor', 'Id_Libro', 'Id_Autor');
    }
    public function tipo()
    {
        return $this->belongsTo(TipoModel::class, 'Id_Tipo', "Id");
    }
    public function prestamo()
    {
        return $this->hasOne(PrestamoModel::class, 'Id_Lector', 'Id');
    }
}
