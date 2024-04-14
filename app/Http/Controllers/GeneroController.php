<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models\GeneroModel;

class GeneroController extends BaseController
{
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {
            $data = GeneroModel::all();
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }

    public function get($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = GeneroModel::find($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    public function getGenero($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = GeneroModel::find($id);
            $data->load('libro');

            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }

    public function insert(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            if ($request->has(["Nombre", "Codigo"])) {
                $data = new GeneroModel();
                $data->Nombre = $request->Nombre;
                $data->Codigo = $request->Codigo;
                $response = $data->save();
                $respuesta->RespuestaInsert($response, $data->id);
            } else {
                $respuesta->RespuestaDatosIncompletos($request->all());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }

    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {
            if ($request->has(["Nombre", "Codigo"])) {
                $data = GeneroModel::findOrFail($id);
                $data->Nombre = $request->Nombre;
                $data->Codigo = $request->Codigo;
                $data->id = $id;
                $response = $data->save();
                $respuesta->RespuestaUpdate($response, $data);
            } else {
                $respuesta->RespuestaDatosIncompletos($request->all());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }

    public function delete($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = GeneroModel::findOrFail($id);
            $data->id = $id;
            $response = $data->delete();
            $respuesta->RespuestaDelete($response, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}
