<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models\EditorialModel;

class EditorialController extends BaseController
{
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {
            $data = EditorialModel::all();
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
            $data = EditorialModel::find($id);
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
            if ($request->has(["Nombre", "Pais"])) {
                $data = new EditorialModel();
                $data->Nombre = $request->Nombre;
                $data->Pais = $request->Pais;
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
            if ($request->has(["Nombre", "Pais"])) {
                $data = EditorialModel::findOrFail($id);
                $data->Nombre = $request->Nombre;
                $data->Pais = $request->Pais;
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
            $data = EditorialModel::findOrFail($id);
            $data->id=$id;
            $response = $data->delete();
            $respuesta->RespuestaDelete($response, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}