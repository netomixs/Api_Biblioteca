<?php

namespace App\Http\Controllers;


use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\AutorModel;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use App\Models\LibroModel;
use Illuminate\Http\Request;
use Exception;

class AutorController extends BaseController
{
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {

            $data = AutorModel::all();
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
            $data = AutorModel::findOrFail($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return response(json_encode($respuesta));
    }
    public function getWithPerson($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = AutorModel::with("persona")->findOrFail($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return response(json_encode($respuesta));
    }
    public function getAllWithPerson()
    {
        $respuesta = new Respuesta();
        try {
            $data = AutorModel::with('persona')->get();
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
            $dataInsert = new AutorModel();
            $dataInsert->Id_Persona = $request->Id_Persona;
            $dataInsert->Codigo = $request->Codigo;
            if ($request->has(["Id_Persona", "Codigo"])) {
                $isInsert = $dataInsert->save();
                $respuesta->RespuestaInsert($isInsert, $dataInsert->id);
            } else {
                $respuesta->RespuestaDatosIncompletos($dataInsert);
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
            $dataInsert =  AutorModel::findOrFail($id);
            $dataInsert->Codigo = $request->Codigo;
            $dataInsert->id = $id;
            if ($request->has(["Codigo"])) {
                $isInsert = $dataInsert->save();
                $respuesta->RespuestaUpdate($isInsert, $dataInsert);
            } else {
                $respuesta->RespuestaDatosIncompletos($dataInsert);
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
            $dataInsert =new AutorModel();
            $dataInsert =  AutorModel::findOrFail($id);
            $dataInsert->id = $id;
            $isSucees = $dataInsert->delete();
            $respuesta->RespuestaDelete($isSucees, $dataInsert);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return response(json_encode($respuesta));
    }
}
