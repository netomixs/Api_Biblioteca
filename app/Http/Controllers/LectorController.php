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

    /**
     * Obten una lista de de los lectores (Usuarios que no adminsitran el sistema) con datos de la persona relacionada
     */
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {

            $data = LectorModel::with("persona")->get();
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
  return $respuesta->toJson();
    }
    /**
     * Obten lector (Usuario que no adminsitra el sistema) con datos de la persona relacionada
     */
    public function get($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = LectorModel::with("persona")->findOrFail($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
  return $respuesta->toJson();
    }
    /**
     * Obten prestamos del lector
     */
    public function getWithPrestamos($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = LectorModel::with("prestamo")->findOrFail($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Inserta nuevo lector en la base de datos (es necesario tener una persona ya registrada)
     * @param Request $request {UDI,Id_Persona}
     */
    public function insert(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'UDI' => 'required|size:18',
                'Id_Persona' => 'required',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data = new LectorModel();
                $data->UDI = $request->UDI;
                $data->Id_Persona = $request->Id_Persona;
                $data->Fecha_Inscripcion = date('Y-m-d');
                $isInsert = $data->save();
                $respuesta->RespuestaInsert($isInsert, $data->Id);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
  return $respuesta->toJson();
    }
    /**
     * @param Request $request {UDI}
     * @param  int $id id del lector
     */
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'UDI' => 'required|size:18'
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data =  LectorModel::findOrFail($id);
                $data->UDI = $request->UDI;
                $isInsert = $data->save();
                $respuesta->RespuestaUpdate($isInsert, $data);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
  return $respuesta->toJson();
    }
    /**
     * @param int $id ID of the user
     */
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
