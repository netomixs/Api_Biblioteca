<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models\LectorModel;

class LectorController extends BaseController
{
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {

            $data = LectorModel::with("persona")->get();
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return response(json_encode($respuesta));
    }
    public function get($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = LectorModel::with("persona")->findOrFail($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return response(json_encode($respuesta));
    }
    public function insert(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            $data = new LectorModel();

            if ($request->has(["UDI", "Id_Persona"])) {
                $data->UDI = $request->UDI;
                $data->Id_Persona = $request->Id_Persona;
                $data->Fecha_Inscripcion = date('Y-m-d ');
                $isInsert = $data->save();
                $respuesta->RespuestaInsert($isInsert, $data->Id);
            } else {
                $respuesta->RespuestaDatosIncompletos($request->all());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return response(json_encode($respuesta));
    }
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {

            $data =  LectorModel::findOrFail($id);

            if ($request->has(["UDI", "Id_Persona"])) {
                $data->UDI = $request->UDI;
                $data->Id_Persona = $request->Id_Persona;
                $data->Fecha_Inscripcion = $request->Fecha_Inscripcion;
                $isInsert = $data->save();
                $respuesta->RespuestaUpdate($isInsert, $data);
            } else {
                $respuesta->RespuestaDatosIncompletos($request->all());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return response(json_encode($respuesta));
    }
    public function delete($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = LectorModel::findOrFail($id);
            $response = $data->delete();
            $respuesta->RespuestaDelete($response, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}
