<?php

namespace App\Http\Controllers;


use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use App\Models\NivelModel;
use Illuminate\Http\Request;
use Exception;

class NivelController extends BaseController
{
    /**
     * Obtener los niveles de usuario (que administran el sistema)
     */
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {
            $data = NivelModel::all();
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
  return $respuesta->toJson();
    }
    /**
     * Obtener Nivel de usuario (que administra el sistema )
     * @param  int $id Id del Nivel de usuario
     */
    public function get($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = NivelModel::find($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
  return $respuesta->toJson();
    }
}
