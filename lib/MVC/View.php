<?php

namespace lib\MVC;

class View
{
    public static $instance;
    protected $view;
    protected $passingVars;
    protected $fullView;
    protected $viewDir = __DIR__ . "/../../views";
    protected $requestedMethod;

    public function __call($name, $args)
    {
        return call_user_func_array(array($this, $name), $args);
    }

    public static function __callStatic($name, $args)
    {
        return call_user_func_array(array(self::getInstance(), $name), $args);
    }

    // public function __construct($method)
    // {
    //     $this->requestedMethod = $method;
    // }

    public static function getInstance()
    {
        // return self::$instance ? self::$instance : new self;
        self::$instance = new self();
        return self::$instance;
    }

    protected function getMethod($method)
    {
        $this->requestedMethod = $method;
    }

    protected function getURI()
    {
        return $_GET;
    }

    protected function render($view, array $passingVars = null, bool $fullView = true)
    {
        $arrayView = explode('.', $view);
        if (count($arrayView) > 1) {
            foreach ($arrayView as $val) {
                $this->view .= '/' . $val;
            }
            $this->view .= '.php';
        } else {
            $this->view = '/' . $view . '.php';
        }
        // $this->view        = $view;

        if (count($passingVars) > 0) {
            foreach ($passingVars as $varName => $varVal) {
                $$varName = $varVal;
            }
        }
        // $this->passingVars = $passingVars;
        // $this->fullView = $fullView;

        $content = $this->viewDir . $this->view;
        if (file_exists($content)) {

            if ($fullView) {
                require __DIR__ . "/../../views/template.php";
            } else {
                require $content;
            }
        } else {
            throw new \Exception('File tidak ada!');
        }

        // $classData = explode("\\", get_class($this));
        // $className = end($classData);

        // $content = __DIR__ . "/../../views/" . $className . "/" . $this->action . ".php";

    }
}
