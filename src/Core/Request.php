<?php

namespace Src\Core;

class Request 
{

    public static function uri() {
        return trim($_SERVER["REQUEST_URI"]);
    }

    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getContent() {
        return file_get_contents('php://input');
    }

    public static function getOrigin() {
        $origin = '';
        if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        } else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $origin = $_SERVER['HTTP_REFERER'];
        } else {
            $origin = $_SERVER['REMOTE_ADDR'];
        }
        return $origin;
    }

}