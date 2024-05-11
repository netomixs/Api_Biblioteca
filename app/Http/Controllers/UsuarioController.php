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
    /**
     * Obtener todos los usuarios con datos de persona y el nivel de usuario
     */
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {
            $data = UsuarioModel::with(["persona", "nivel"])->get();

            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Obtener  usuario con datos de persona y el nivel de usuario
     * @param int $Id Id del usuario
     */
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
    public function login(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'Usuario' => 'required',
                'Password' => 'required'
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
      
                $hash_contrasena = hash("sha256", $request->Password);
                $data =   UsuarioModel::where('Usuario', $request->Usuario)
                ->where('Password', $hash_contrasena)
                ->first();
                $respuesta->RespuestaGet($data);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Insertar usuario en la base de datos
     * @param Request $request {Usuario,Password,Clave_Empleado,Id_Persona,Nivel}
     */
    public function insert(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            $data = new UsuarioModel();
            $rules = [
                'Usuario' => 'required',
                'Password' => 'required',
                'Clave_Empleado' => 'required',
                'Id_Persona' => 'required',
                'Nivel' => 'required',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
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
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Actualiza usuario en la base de datos
     * @param Request $request  {Usuario,Clave_Empleado,Nivel}
     */
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'Usuario' => 'required',
                'Clave_Empleado' => 'required',
                'Nivel' => 'required',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data =   UsuarioModel::findOrFail($id);
                $data->Usuario = $request->Usuario;
                $data->Clave_Empleado = $request->Clave_Empleado;
                $data->Nivel = $request->Nivel;
                $data->id = $id;
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
     * Actualizar contraseña del usuario
     * @param Request $request {oldPassword,newPassword}
     * @param int $id ide del usuario
     */
    public function updatePassword(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'oldPassword' => 'required',
                'newPassword' => 'required',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data =   UsuarioModel::findOrFail($id);
                $hash_contrasenaOld = hash("sha256", $request->oldPassword);
                $hash_contrasenaNew = hash("sha256", $request->newPassword);
                if ($data->Password == $hash_contrasenaOld) {
                    $data->id = $id;
                    $data->Password = $hash_contrasenaNew;
                    $response = $data->save();
                    $respuesta->RespuestaUpdate($response, $data->id);
                } else {
                    $respuesta->respuesta(203, false, "Las contraseña ingresada no coincide con la registrada", $request->all());
                }
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Eliminar usuario de la base de datos
     * @param int $id Id del usuario
     */
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
