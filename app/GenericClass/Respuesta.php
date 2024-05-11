<?php

namespace App\GenericClass;

use Illuminate\Database\Eloquent\Model;

class Respuesta
{
    public $Code;
    public $CodeDesc;
    public $IsSuccess;
    public $Message;
    public $Data;

    public function respuesta($code, $IsSuccess, $Message, $Data)
    {

        $this->Code = $code;
        $this->CodeDesc = HttpCode::getMessageForCode($code);
        $this->IsSuccess = $IsSuccess;
        $this->Message = $Message;
        $this->Data = $Data;
        return $this;
    }
    public function RespuestaInsert($IsSuccess, $data)
    {
        if ($IsSuccess) {
            $this->Code = 201;
            $this->CodeDesc = HttpCode::getMessageForCode(201);
            $this->IsSuccess = $IsSuccess;
            $this->Message = "Insercion correcta";
            $this->Data = $data;
        } else {
            $this->Code = 501;
            $this->CodeDesc = HttpCode::getMessageForCode(501);
            $this->IsSuccess = $IsSuccess;
            $this->Message = "No se pudo realizar la inserción";
            $this->Data = $data;
        }

        return $this;
    }
    public function RespuestaGet($data)
    {
        if ($data != null) {
            if ($data->count() > 0) {
                $this->Code = 200;
                $this->CodeDesc = HttpCode::getMessageForCode(200);
                $this->IsSuccess = true;
                $this->Message = "Consulta ";
                $this->Data = $data;
            } else {
                $this->Code = 204;
                $this->CodeDesc = HttpCode::getMessageForCode(204);
                $this->IsSuccess = true;
                $this->Message = "Consulta exitosa pero no hay datos a mostrar";
                $this->Data = $data;
            }
        }else {
            $this->Code = 204;
            $this->CodeDesc = HttpCode::getMessageForCode(204);
            $this->IsSuccess = true;
            $this->Message = "Consulta exitosa pero no hay datos a mostrar";
            $this->Data = $data;
        }


        return $this;
    }
    public function RespuestaUpdate($IsSuccess, $data)
    {
        if ($IsSuccess) {
            $this->Code = 200;
            $this->CodeDesc = HttpCode::getMessageForCode(201);
            $this->IsSuccess = $IsSuccess;
            $this->Message = "Actualizacion correcta";
            $this->Data = $data;
        } else {
            $this->Code = 501;
            $this->CodeDesc = HttpCode::getMessageForCode(501);
            $this->IsSuccess = $IsSuccess;
            $this->Message = "No se puedo actualizar";
            $this->Data = $data;
        }

        return $this;
    }
    public function RespuestaDelete($IsSuccess, $data)
    {
        if ($IsSuccess) {
            $this->Code = 200;
            $this->CodeDesc = HttpCode::getMessageForCode(201);
            $this->IsSuccess = $IsSuccess;
            $this->Message = "Eliminación correcta";
            $this->Data = $data;
        } else {
            $this->Code = 501;
            $this->CodeDesc = HttpCode::getMessageForCode(501);
            $this->IsSuccess = $IsSuccess;
            $this->Message = "No se puedo eliminar";
            $this->Data = $data;
        }

        return $this;
    }
    public function RespuestaDatosIncompletos($data)
    {
        $this->Code = 406;
        $this->CodeDesc = HttpCode::getMessageForCode(406);
        $this->IsSuccess = false;
        $this->Message = "La peticion n0 tiene los campos necesarios para la consulta";
        $this->Data = $data;
    }
    public function RespuestaBadRequest($data, $error)
    {
        $this->Code = 500;
        $this->CodeDesc = HttpCode::getMessageForCode(500);
        $this->IsSuccess = false;
        $this->Message = $error;
        $this->Data = $data;
    }
    public function toJson()
    {
        return json_encode($this,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
