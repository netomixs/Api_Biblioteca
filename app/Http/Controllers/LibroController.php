<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\GenericClass\Respuesta;
use App\GenericClass\HttpCode;
use Illuminate\Http\Request;
use Exception;
use App\Models\LibroModel;

class LibroController extends BaseController
{

    /**
     * Obtener una lista de los libro de la base de datos con genero, autor con datos de la persona y el tipo de libro
     */
    public function getAll()
    {
        $respuesta = new Respuesta();
        try {

            $data = LibroModel::with(["genero", "autor.persona", "tipo"])->get();
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Obtener libro con genero y datos del autor con persona
     * @param  int $id id del libro
     */
    public function get($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = LibroModel::with("genero", "autor.persona")->find($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
        /**
     * Obtener prestamos por libro
     * @param  int $id id del libro
     */
    public function getWhitPrestamos($id)
    {
        $respuesta = new Respuesta();
        try {
            $data = LibroModel::with("prestamo")->find($id);
            $respuesta->RespuestaGet($data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Insertar libro en la base de datos
     * @param  Request $request{ISBN,Titulo,Descripcion,Descripcion,Fecha_Publicacion,
     * Feha_Adquicicion,Existencias,Es_Prestable,Imagen,Id_Tipo,Id_Editorial,Codigo,Id_Genero,Id_Autor}
     * Imagen puede ser un string o un archivo de imagen
     */
    public function insert(Request $request)
    {
        $respuesta = new Respuesta();

        try {
            $rules = [
                'ISBN' => 'required|string|size:13',
                'Titulo' => 'required|string|max:255',
                'Descripcion' => 'required|string',
                'Fecha_Publicacion' => 'required|date',
                'Feha_Adquicicion' => 'required|date',
                'Existencias' => 'required|integer',
                'Es_Prestable' => 'required|boolean',
                'Imagen' => 'required',
                'Id_Tipo' => 'required|integer',
                'Id_Editorial' => 'required|integer',
                'Codigo' => 'required|string',
                'Id_Genero' => 'required|integer',
                'Id_Autor' => 'required|integer',

            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data = new LibroModel();
                if ($request->hasFile("Imagen")) {
                    $image = $request->file('Imagen');
                    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                    // $image->storeAs('public/uploads/imagenes', $imageName);
                    $image->move('./uploads/imagenes', $imageName);
                    $data->Imagen =  $imageName;
                } else {
                    $data->Imagen = $request->Imagen;
                }
                $data->ISBN = $request->ISBN;
                $data->Titulo = $request->Titulo;
                $data->Descripcion = $request->Descripcion;
                $data->Fecha_Publicacion = $request->Fecha_Publicacion;
                $data->Feha_Adquicicion = $request->Feha_Adquicicion;
                $data->Existencias = $request->Existencias;
                $data->Es_Prestable = $request->Es_Prestable;
                $data->Id_Tipo = $request->Id_Tipo;
                $data->Id_Editorial = $request->Id_Editorial;
                $data->Codigo = $request->Codigo;
                $response = $data->save();
                $data->generoInsert()->attach($request->Id_Genero);
                $data->autorInsert()->attach($request->Id_Autor);
                $respuesta->RespuestaInsert($response, $data->id);
            } else {
                $respuesta->RespuestaDatosIncompletos($validator->errors());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        $data = new LibroModel();
        try {
            $rules = [
                'ISBN' => 'required|string|size:13',
                'Titulo' => 'required|string|max:255',
                'Descripcion' => 'required|string',
                'Fecha_Publicacion' => 'required|date',
                'Feha_Adquicicion' => 'required|date',
                'Existencias' => 'required|integer',
                'Es_Prestable' => 'required|boolean',
                'Id_Tipo' => 'required|integer',
                'Id_Editorial' => 'required|integer',
                'Codigo' => 'required|string',
                'Id_Genero' => 'required|integer',
                'Id_Autor' => 'required|integer',

            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data =  LibroModel::findOrFail($id);
                $data->id = $id;
                $data->ISBN = $request->ISBN;
                $data->Titulo = $request->Titulo;
                $data->Descripcion = $request->Descripcion;
                $data->Fecha_Publicacion = $request->Fecha_Publicacion;
                $data->Feha_Adquicicion = $request->Feha_Adquicicion;
                $data->Existencias = $request->Existencias;
                $data->Es_Prestable = $request->Es_Prestable;
                $data->Id_Tipo = $request->Id_Tipo;
                $data->Id_Editorial = $request->Id_Editorial;
                $data->Codigo = $request->Codigo;
                $data->genero()->sync([$request->Id_Genero]);
                $data->autor()->sync([$request->Id_Autor]);
                $response = $data->save();
                $respuesta->RespuestaUpdate($response, $data);
            } else {
                $respuesta->RespuestaUpdate(false, $request->all());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * Actualiza la imagen de un libro especificado
     * @param Request $request {Imagen}
     * Imagen puede ser File o String
     * @param  int $id Id del libro
     */
    public function updateImage(Request $request, $id)
    {
        $respuesta = new Respuesta();
        $data = new LibroModel();
        try {
            $rules = [
                'Imagen' => 'required',
            ];
            $validator = Validator($request->all(), $rules);
            $validator->errors()->toArray();
            if (!$validator->fails()) {
                $data = LibroModel::findOrFail($id);
                $data->id = $id;
                if ($request->hasFile("Imagen")) {
                    $image = $request->file('Imagen');
                    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

                    $image->move('./uploads/imagenes', $imageName);
                    $origen = "./uploads/imagenes" . $data->Imagen;
                    if (file_exists($origen)) {
                        unlink($origen);
                    }
                    $data->Imagen = $imageName;
                    $data->save();
                    $respuesta->RespuestaUpdate(true, $data);
                } else {
                    $data->Imagen = $request->Imagen;
                    $data->save();
                    $respuesta->RespuestaUpdate(true, $data);
                }
            } else {
                $respuesta->RespuestaUpdate(false, $request->all());
            }
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
        return $respuesta->toJson();
    }
    /**
     * @param  int $id Elimina libro
     */
    public function delete($id)
    {
        $respuesta = new Respuesta();

        try {
            $data = new LibroModel();
            $data =  LibroModel::findOrFail($id);
            $data->id = $id;
            $isSucees = $data->delete();
            $origen = "./uploads/imagenes" . $data->Imagen;
            if (file_exists($origen)) {
                unlink($origen);
            }
            $respuesta->RespuestaDelete($isSucees, $data);
        } catch (Exception $e) {
            $respuesta->RespuestaBadRequest(null, $e);
        }
  return $respuesta->toJson();
    }
}
