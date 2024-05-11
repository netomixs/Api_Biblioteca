<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models;
use App\Models\PrestamoModel;

class PrestamoController extends BaseController
{
    /**
     * Obtener todos los prestamos exisatentes
     */
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {
          //  $data = PrestamoModel::all();
            $data = PrestamoModel ::with("libro")->get();
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Obtener prestamo por Id
     * @param int $id Id del prestamo
     */
    public function get($id)
    {
        $respuesta = new Respuesta();
        try {
           // $data = PrestamoModel::find($id);
           $data = PrestamoModel ::with("lector.persona","libro")->findOrFail($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Insertar prestamo en la base de datos
     * @param Request $request {Fecha_FIn,Id_Libro,Id_Administrador,Id_Lector}
     * Fecha_FIn fecha establecidad para entregar el libro
     */
    public function insert(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            $rules = [
                'Fecha_FIn' => 'required',
                'Id_Libro' => 'required',
                'Id_Administrador' => 'required',
                'Id_Lector' => 'required',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data = new PrestamoModel();
                $data->Fecha_FIn = $request->Fecha_FIn;
                $data->Id_Libro = $request->Id_Libro;
                $data->Id_Administrador = $request->Id_Administrador;
                $data->Id_Lector = $request->Id_Lector;
                $data->Fecha_Entrega = null;
                $data->Fecha_Inicio = date('Y-m-d H:i:s');
                $response = $data->save();
                $respuesta->RespuestaInsert($response, $data->Id);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Actualizar prestamo en la base de datos
     * @param Request $request {Fecha_FIn,Fecha_Entrega}
     * Fecha_FIn fecha establecida para la entrega
     * Fecha_Entrega Entrega real del libro
     * @param int $id Id del Prestamo
     */
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();


        try {
            $rules = [
                'Fecha_FIn' => 'required',
                'Fecha_Entrega' => 'required',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data =  PrestamoModel::findOrFail($id);
                $data->Fecha_FIn = $request->Fecha_FIn;
                $data->Fecha_Entrega = $request->Fecha_Entrega;;
                $response = $data->save();
                $respuesta->RespuestaInsert($response, $data);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Eliminar prestmo de la base de datos
     * @param int $id Id del prestamo
     */
    public function delete($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = PrestamoModel::findOrFail($id);
            $response = $data->delete();
            $respuesta->RespuestaDelete($response, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}
