<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class PrestamoModel extends Model
{
    public $timestamps = false;
    protected $table = 'prestamo';
    protected $primaryKey = 'Id';
    public function lector()
    {
        return $this->belongsTo(LectorModel::class, 'Id_Lector', "Id");
    }
    public function libro()
    {
        return $this->belongsTo(LibroModel::class, 'Id_Libro', "Id");
    }
    public function usuario()
    {
        return $this->belongsTo(UsuarioModel::class, 'Id_Administrador', "Id");
    }
}
