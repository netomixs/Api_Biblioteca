<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models;
use App\Models\PrestamoModel;

class PrestamoController extends BaseController
{
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {
            $data = PrestamoModel::all();
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
            $data = PrestamoModel::find($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    public function insert(Request $request)
    {
        $respuesta = new Respuesta();
        $data = new PrestamoModel();
        try {
            if ($request->has(["Fecha_FIn", "Id_Libro", "Id_Administrador", "Id_Lector"])) {
                $data->Fecha_FIn = $request->Fecha_FIn;
                $data->Id_Libro = $request->Id_Libro;
                $data->Id_Administrador = $request->Id_Administrador;
                $data->Id_Lector = $request->Id_Lector;
                $data->Fecha_Entrega = null;
                $data->Fecha_Inicio = date('Y-m-d H:i:s');
                $response = $data->save();
                $respuesta->RespuestaInsert($response, $data->Id);
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
            $data =  PrestamoModel::findOrFail($id);
            if ($request->has(["Fecha_FIn", "Fecha_Entrega"])) {
                $data->Fecha_FIn = $request->Fecha_FIn;
                $data->Fecha_Entrega = $request->Fecha_Entrega;;
                $response = $data->save();
                $respuesta->RespuestaInsert($response, $data);
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
            $data = PrestamoModel::findOrFail($id);
            $response = $data->delete();
            $respuesta->RespuestaDelete($response, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}
