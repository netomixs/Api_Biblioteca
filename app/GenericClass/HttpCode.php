<?php

namespace App\GenericClass;

class HttpCode
{
    public static function getMessageForCode($code)
    {
        $status = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => ' Non-Authoritative',
            204 => 'No Content',
            500=>'Internal Server Error',
            501=>'Not Implemented',
            406 =>'Not Acceptable'
        );
        return ($status[$code]) ? $status[$code] : 'Unknown HTTP status code';
    }
}
