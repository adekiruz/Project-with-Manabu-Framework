<?php

namespace lib\MVC;

class Route
{

    public static $routedURI  = [];
    public static $controller = [];
    public static $method     = [];

    public static function addr($uri, $controller, $method = null)
    {
        if (empty($controller)) {
            throw new \Exception('Controller belum ditentukan pada penulisan Router!');
        }
        if (empty($method)) {
            // throw new \Exception('Method belum ditentukan pada penulisan Router!');
        }

        self::$controller[]    = $controller;
        self::$routedURI[$uri] = [$controller, $method]; /* . '@' . $controller . '@' . $method;*/
        self::$method[]        = $method;

    }

}
