<?php

namespace Api\Controllers;

class HttpController
{
    public static function headers()
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Headers: Content-Type");
    }
}
