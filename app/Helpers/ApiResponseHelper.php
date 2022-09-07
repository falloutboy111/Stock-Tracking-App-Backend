<?php

namespace App\Helpers;

class ApiResponseHelper
{
    public static function success($message, $data = [], $code = 200)
    {
        return response()->json(["message" => $message, "data" => $data], $code);
    }

    public static function error($message, $data = [], $code = 400)
    {
        return response()->json(["message" => $message, "error" => $data], $code);
    }
}