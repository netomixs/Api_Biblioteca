<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


 class TipoModel extends Model{
    public $timestamps = false;

    protected $table = 'tipo'; 
    public function libro(){
        return $this->hasOne(LibroModel::class, 'Id ','Id_Tipo');
    }
}