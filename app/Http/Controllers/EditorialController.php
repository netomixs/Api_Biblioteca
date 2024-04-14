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
                $respuesta->RespuestaDatosIncompletos($validator->errors()->toArray() );
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
