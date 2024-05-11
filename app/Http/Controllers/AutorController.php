<?php

namespace App\Http\Controllers;


use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\AutorModel;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use App\Models\LibroModel;
use Illuminate\Http\Request;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Exception;

class AutorController extends BaseController
{
    /** 
     * Se obtiene una lista de todos los autores
     * 
    */
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {

            $data = AutorModel::all();
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Datos del autor
     * @param int $id Id del autor
     */
    public function get($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = AutorModel::findOrFail($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
        /**
     * Datos del autor con datos de la persona asociada
     * @param int $id Id del autor
     */
    public function getWithPerson($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = AutorModel::with("persona")->findOrFail($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
       
    /**
     *Lista de los datos de los autores con la persona asociada 
     */
    public function getAllWithPerson()
    {
        $respuesta = new Respuesta();
        try {
            $data = AutorModel::with('persona')->get();
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }

        return $respuesta->toJson();
    }
    /**
     * Insercion en la tabla autor es necesario contar con una persona resgitrada previemente
     * @param Request $request {Id_Persona, Codigo}
     */
    public function insert(Request $request)
    {
        $respuesta = new Respuesta();
        try {
            $dataInsert = new AutorModel();
            $dataInsert->Id_Persona = $request->Id_Persona;
            $dataInsert->Codigo = $request->Codigo;
            $rules = [
                'Id_Persona' => 'required',
                'Codigo' => 'required',
            ];
            $validator = Validator($request->all(), $rules);
            if (!$validator->fails()) {
                $isInsert = $dataInsert->save();
                $respuesta->RespuestaInsert($isInsert, $dataInsert->id);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors()->toArray());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * @param Request $request {Codigo}
     * @param  int $id Id del registro afectado
     */
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        try {
            $dataInsert =  AutorModel::findOrFail($id);
            $dataInsert->Codigo = $request->Codigo;
            $dataInsert->id = $id;
            $rules = [
                'Codigo' => 'required',
            ];
            $validator = Validator($request->all(), $rules);
            if (!$validator->fails()) {
                $isInsert = $dataInsert->save();
                $respuesta->RespuestaUpdate($isInsert, $dataInsert);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors()->toArray());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * @param int $id id del autor. Borra la persona relacionada
     */
    public function delete($id)
    {
        $respuesta = new Respuesta();

        try {
            $dataInsert = new AutorModel();
            $dataInsert =  AutorModel::findOrFail($id);
            $dataInsert->id = $id;
            $isSucees = $dataInsert->delete();
            $respuesta->RespuestaDelete($isSucees, $dataInsert);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Lista de los libros escritos por el autor
     * @param int $id Id del autor
     */
    public function getLibros($id)
    {
        $respuesta = new Respuesta();
        try {

            $data = AutorModel::with("libro")->find($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
}
