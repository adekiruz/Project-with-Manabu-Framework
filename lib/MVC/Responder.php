<?php

namespace lib\MVC;

use lib\MVC\Route;
use lib\MVC\View;

class Responder extends View
{
    public $uri;
    public $arrayURI;
    public $controller;
    public $method;
    public $controllerAndMethod;
    private $Controller_Namespace = "\\controllers\\";
    private $Base_Controller_Name = "lib\\MVC\\View";

    public function __construct($requestURI)
    {
        if (count($requestURI) > 0) {

            foreach ($requestURI as $key => $val) {
                $this->uri = $key;
            }
        } else {
            $this->uri = '/tes';
        }
    }

    public function response()
    {
        if ($this->uri != null) {
            foreach (Route::$routedURI as $key => $val) {
                $arrayPath[] = $key;
            }

            $this->arrayURI = Route::$routedURI;
            if (!in_array($this->uri, $arrayPath)) {
                throw new \Exception('Route belum didaftarkan!');
            } else {
                $this->controllerAndMethod = $this->arrayURI[$this->uri];
                if (is_string($this->controllerAndMethod[0])) {

                    $this->controller = $this->Controller_Namespace . $this->controllerAndMethod[0];
                    $this->method     = $this->controllerAndMethod[1];

                    $this->sendResponse();
                } else {
                    echo $this->controllerAndMethod[0]();
                }
            }
        }
    }

    public function sendResponse()
    {
        // echo $this->controller;
        // exit;

        if (class_exists($this->controller)) {
            $parent = class_parents($this->controller);

            if (method_exists($this->controller, $this->method)) {
                // echo $this->method;
                // return;
                $this->getMethod($this->method);
                // return new $this->controller($this->method);

            } else {
                throw new \Exception('Method tidak ada!');
            }

        } else {
            throw new \Exception('Controller tidak ada!');
        }

    }

    public function prepareExecution()
    {

        $executedController = new $this->controller;
        return $executedController->{$this->requestedMethod}();
    }

    public function execute()
    {
        if (isset($this->controller)) {
            return $this->prepareExecution();
        }
    }
}
