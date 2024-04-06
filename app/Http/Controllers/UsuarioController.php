<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {
            $data = UsuarioModel::with(["persona","nivel"])->get();

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
            $data = UsuarioModel::find($id);
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
            $data = new UsuarioModel();
            if ($request->has(["Usuario", "Password", "Clave_Empleado", "Id_Persona", "Nivel"])) {
                $currentDateTime = date("Y-m-d H:i:s");
                $data->Usuario = $request->Usuario;
                $data->Password = $request->Password;
                $data->Fecha_Registro =   $currentDateTime;
                $data->Clave_Empleado = $request->Clave_Empleado;
                $data->Id_Persona = $request->Id_Persona;
                $data->Nivel = $request->Nivel;
                $hash_contrasena = hash("sha256", $request->Password);
                $data->Password = $hash_contrasena;
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

            if ($request->has(["Usuario", "Clave_Empleado", "Nivel"])) {
                $data =   UsuarioModel::findOrFail($id);
                $data->Usuario = $request->Usuario;
                $data->Clave_Empleado = $request->	Clave_Empleado;
                $data->Nivel = $request->Nivel;
                $data->id = $id;
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
    public function updatePassword(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {

            if ($request->has(["oldPassword", "newPassword"])) {
                $data =   UsuarioModel::findOrFail($id);
                $hash_contrasenaOld = hash("sha256", $request->oldPassword);
                $hash_contrasenaNew = hash("sha256", $request->newPassword);
                if ($data->Password == $hash_contrasenaOld) {
                    $data->id = $id;
                    $data->Password = $hash_contrasenaNew;
                    $response = $data->save();
                    $respuesta->RespuestaUpdate($response, $data->id);
                } else {
                    $respuesta->respuesta(203,false, "Las contraseña ingresada no coincide con la registrada",$request->all());
                }
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
            $data =   UsuarioModel::findOrFail($id);
            $data->id = $id;
            $response = $data->delete();
            $respuesta->RespuestaDelete($response, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}
