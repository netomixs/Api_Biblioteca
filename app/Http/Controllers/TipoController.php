<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models\TipoModel;

class TipoController extends BaseController
{
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {
            $data = TipoModel::all();
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
            $data = TipoModel::find($id);
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
                $data = new TipoModel();
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
                $data = TipoModel::findOrFail($id);
                $data->Nombre = $request->Nombre;
                $data->Codigo = $request->Codigo;
                $data->id=$id;
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
            $data = TipoModel::findOrFail($id);
            $data->id=$id;
            $response = $data->delete();
            $respuesta->RespuestaDelete($response, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}