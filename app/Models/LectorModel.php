<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class LectorModel extends Model
{
    public $timestamps = false;
    protected $table = 'lector';
    protected $primaryKey = 'Id';
    public function persona()
    {
        return $this->belongsTo(PersonaModel::class, 'Id_Persona', "Id");
    }
   public function prestamo(){
    return $this->hasMany(PrestamoModel::class, 'Id_Lector','Id');
   }
}
