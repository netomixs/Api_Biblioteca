<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models\GeneroModel;
use Illuminate\Validation\Validator;

class GeneroController extends BaseController
{
    /**
     * Obten una lista de todos los generos registrados en la base de datos	
     */
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

    /**
     * Obtener datos del genero especificado
     * @param int $id Id del genero
     */
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
    /**
     * Obtener lista de libros del genero especificado
     * @param int $id Id del genero
     */
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
    /**
     * Insertar nuevo Genero
     * @param  Request $request {Nombre,Codigo}
     */
    public function insert(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'Nombre' => 'required',
                'Codigo' => 'required|size:3',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data = new GeneroModel();
                $data->Nombre = $request->Nombre;
                $data->Codigo = $request->Codigo;
                $response = $data->save();
                $respuesta->RespuestaInsert($response, $data->id);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * actualziar datos Genero
     * @param  Request $request {Nombre,Codigo}
     * @param int $id id del genero
     */
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'Nombre' => 'required',
                'Codigo' => 'required|size:3',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data = GeneroModel::findOrFail($id);
                $data->Nombre = $request->Nombre;
                $data->Codigo = $request->Codigo;
                $data->id = $id;
                $response = $data->save();
                $respuesta->RespuestaUpdate($response, $data);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
/**
 * Elimina genero de la base de datos
 * @param int $id Id del genero
 */
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
