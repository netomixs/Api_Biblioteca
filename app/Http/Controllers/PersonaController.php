<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\PersonaModel;
use Illuminate\Http\Request;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;

class PersonaController extends BaseController
{
    /**
     * Obten una lista de todas las personas
     */
    function  getAll()
    {
        $respuesta = new Respuesta();
        try {
            $data = PersonaModel::all();
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
  return $respuesta->toJson();
    }
    /**
     * Obten un registro por id
     * @param int $Id	Id del registro
     */
    function  get($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = PersonaModel::find($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
  return $respuesta->toJson();
    }
    /**
     * Insertar persona en la base de datos
     * @param Request $request {Nombre,Apellido_P,Apellido_M,Nacimiento,Sexo}
     */
    function insert(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'Nombre' => 'required',
                'Apellido_P' => 'required',
                'Nacimiento' => 'required',
                'Sexo' => 'required|size:1',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $dataInsert = new PersonaModel();
                $dataInsert->Nombre = $request->Nombre;
                $dataInsert->Apellido_P = $request->Apellido_P;
                $dataInsert->Apellido_M = $request->Apellido_M;
                $dataInsert->Nacimiento = $request->Nacimiento;
                $dataInsert->Sexo = $request->Sexo;
                $response = $dataInsert->save();
                $respuesta->RespuestaInsert($response, $dataInsert->id);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Actualizar datos de una persona
     * @param Request $request {Nombre,Apellido_P,Apellido_M,Nacimiento,Sexo}
     * @param int $id Id de la persona
     */
    function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'Nombre' => 'required',
                'Apellido_P' => 'required',
                'Nacimiento' => 'required',
                'Sexo' => 'required|size:1',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $dataInsert = new PersonaModel();
                $dataInsert = PersonaModel::find($id);
                $dataInsert->Nombre = $request->Nombre;
                $dataInsert->id = $id;
                $dataInsert->Apellido_P = $request->Apellido_P;
                $dataInsert->Apellido_M = $request->Apellido_M;
                $dataInsert->Apellido_M = $request->Apellido_M;
                $dataInsert->Nacimiento = $request->Nacimiento;
                $dataInsert->Sexo = $request->Sexo;
                $response = $dataInsert->save();
                $respuesta->RespuestaUpdate($response, $dataInsert);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Eliminar persona de la base de datos
     * @param int $id Id de la persona
     */
    function delete($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = PersonaModel::findOrFail($id);
            $data->id = $id;
            $response = $data->delete();
            $respuesta->RespuestaDelete($response, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}
