<?php

require 'Controller.php';

final class Application
{
    private static $instance;

    private function __construct()
    {
        //forbid new instances
    }

    public static function getInstance()
    {
        if(self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function run()
    {
        $controller = new Controller();

        if(!empty($_POST)) {
            return $controller->processPost($_POST);
        }

        return $controller->index();
    }
}
