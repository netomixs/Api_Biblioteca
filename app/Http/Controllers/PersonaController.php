<?php

namespace App\Http\Controllers;


use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\PersonaModel;
use Illuminate\Http\Request;


use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;

class PersonaController extends BaseController
{
    function  getAll()
    {
        $resquesta = new Respuesta();
        $data = PersonaModel::all();
        if ($data->count() > 0) {
            $resquesta->Code = 200;
            $resquesta->CodeDesc = HttpCode::getMessageForCode(200);
            $resquesta->Data = $data;
            $resquesta->IsSuccess = true;
            $resquesta->Message = "Consulta exitosa";
        } else {
            $resquesta->Code = 204;
            $resquesta->CodeDesc = HttpCode::getMessageForCode(204);;
            $resquesta->Data = null;
            $resquesta->IsSuccess = true;
            $resquesta->Message = "No hay datos";
        }
        return response(json_encode($resquesta));
    }
    /**
     * Obten un registro por id
     * @param Request $Id	
     */
    function  get($id)
    {
        $resquesta = new Respuesta();
        $data = PersonaModel::find($id);
        if ($data->count() > 0) {
            $resquesta->Code = 200;
            $resquesta->CodeDesc = HttpCode::getMessageForCode(200);
            $resquesta->Data = $data;
            $resquesta->IsSuccess = true;
            $resquesta->Message = "Consulta exitosa";
        } else {
            $resquesta->Code = 204;
            $resquesta->CodeDesc = HttpCode::getMessageForCode(204);;
            $resquesta->Data = null;
            $resquesta->IsSuccess = true;
            $resquesta->Message = "No hay datos";
        }
        return response(json_encode($resquesta));
    }
    function insert(Request $request)
    {
        $respuesta = new Respuesta();
        $dataInsert = new PersonaModel();
        $dataInsert->Nombre = $request->Nombre;
        $dataInsert->Apellido_P = $request->Apellido_P;
        $dataInsert->Apellido_M = $request->Apellido_M;
        $dataInsert->Nacimiento = $request->Nacimiento;
        $dataInsert->Sexo = $request->Sexo;
        if ($request->has(["Nombre", "Apellido_P", "Nacimiento", "Sexo"])) {


            if ($dataInsert->save()) {
                $respuesta->Code = 202;
                $respuesta->CodeDesc = HttpCode::getMessageForCode(202);
                $respuesta->Data =  $dataInsert->id;
                $respuesta->IsSuccess = true;
                $respuesta->Message = "Inserción exitosa";
            } else {
                $respuesta->Code = 406;
                $respuesta->CodeDesc = HttpCode::getMessageForCode(406);;
                $respuesta->Data = null;
                $respuesta->IsSuccess = true;
                $respuesta->Message = "Error al insertar";
            }
        } else {
            $respuesta->Code = 406;
            $respuesta->CodeDesc = HttpCode::getMessageForCode(406);;
            $respuesta->Data = $dataInsert;
            $respuesta->IsSuccess = true;
            $respuesta->Message = "Datos insuficientes";
        }
        return response(json_encode($respuesta));
    }
    function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        $dataInsert = new PersonaModel();
        $dataInsert = PersonaModel::find($id);
        $dataInsert->Nombre = $request->Nombre;
        $dataInsert->id = $id;
        $dataInsert->Apellido_P = $request->Apellido_P;
        $dataInsert->Apellido_M = $request->Apellido_M;
        $dataInsert->Apellido_M = $request->Apellido_M;
        $dataInsert->Nacimiento = $request->Nacimiento;
        $dataInsert->Sexo = $request->Sexo;
        if ($request->has(["Nombre", "Apellido_P", "Nacimiento", "Sexo"])) {
            if ($dataInsert->save()) {
                $respuesta->Code = 202;
                $respuesta->CodeDesc = HttpCode::getMessageForCode(202);
                $respuesta->Data =  $dataInsert;
                $respuesta->IsSuccess = true;
                $respuesta->Message = "Actualizacion exitosa";
            } else {
                $respuesta->Code = 501;
                $respuesta->CodeDesc = HttpCode::getMessageForCode(501);;
                $respuesta->Data = null;
                $respuesta->IsSuccess = true;
                $respuesta->Message = "Error al actualizar";
            }
        } else {
            $respuesta->Code = 406;
            $respuesta->CodeDesc = HttpCode::getMessageForCode(406);;
            $respuesta->Data = $dataInsert;
            $respuesta->IsSuccess = true;
            $respuesta->Message = "Datos insuficientes";
        }
        return response(json_encode($respuesta));
    }
    function delete($id)
    {
        $respuesta = new Respuesta();
        $dataInsert =   PersonaModel::find($id);
        $dataInsert = new PersonaModel();
        $execute = $dataInsert->eliminar($id);
        if ($execute > 0) {
            $respuesta->Code = 202;
            $respuesta->CodeDesc = HttpCode::getMessageForCode(202);
            $respuesta->Data =  $execute;
            $respuesta->IsSuccess = true;
            $respuesta->Message = "Eliminacion exitosa";
        } else {
            $respuesta->Code = 204;
            $respuesta->CodeDesc = HttpCode::getMessageForCode(204);;
            $respuesta->Data = null;
            $respuesta->IsSuccess = true;
            $respuesta->Message = "Error al eliminar";
        }


        return response(json_encode($respuesta));
    }
}
