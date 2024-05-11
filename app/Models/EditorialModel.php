<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

 class EditorialModel extends Model{
    public $timestamps = false;

    protected $table = 'editorial'; 
    protected $primaryKey = 'Id';
    public function libros()
    {
        return $this->hasMany(LibroModel::class, 'Id_Editorial','Id');
    }
}