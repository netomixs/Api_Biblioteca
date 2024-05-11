<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models\EditorialModel;
use Illuminate\Validation\Validator;

class EditorialController extends BaseController
{
    /**
     * Lista de todas las editoriales registradas
     */
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
    /**
     * Datos del editorial y que libros tiene
     * @param int $id Id del editorial
     */
    public function get($id)
    {
        $respuesta = new Respuesta();
        try {
           // $data = EditorialModel::find($id);
           $data = EditorialModel::with("libros")->findOrFail($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Insertar editorial en la base de datos
     * @param Request $request {Nombre,Pais}
     */
    public function insert(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'Nombre' => 'required',
                'Pais' => 'required|min:6',
            ];
            $validator = Validator($request->all(), $rules);

            //  if ($request->has(["Nombre", "Pais"])) {
            if (!$validator->fails()) {
                $data = new EditorialModel();
                $data->Nombre = $request->Nombre;
                $data->Pais = $request->Pais;
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
     * @param Request $request {Nombre,Pais}
     * @param  int $id Id de la editorial
     */
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'Nombre' => 'required',
                'Pais' => 'required|min:6',
            ];
            $validator = Validator($request->all(), $rules);
            //  if ($request->has(["Nombre", "Pais"])) {
            if (!$validator->fails()) {
                $data = EditorialModel::findOrFail($id);
                $data->Nombre = $request->Nombre;
                $data->Pais = $request->Pais;
                $data->id = $id;
                $response = $data->save();
                $respuesta->RespuestaUpdate($response, $data);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors()->toArray());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Borra editorial de la base de datos
     * @param int $id Id de la editorial
     */
    public function delete($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = EditorialModel::findOrFail($id);
            $data->id = $id;
            $response = $data->delete();
            $respuesta->RespuestaDelete($response, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}
