<?php

require 'View.php';
require 'Model.php';

class Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }

    public function index()
    {
        $params = [];
        //get all records if they are needed
        //$params['records'] = $this->model->getAll();

        return $this->view->render('layout.php', $params);
    }

    public function processPost($request)
    {
        $params = [];
        
        if($errors = $this->getRequestErrors($request)) {
            $params['errors'] = $errors;
        } else {
            $params['topRecords'] = $this->model->getTop(3);
            $params['filteredRecords'] = $this->model->getByOrigin($request['origin']);
        }

        return $this->view->render('layout.php', $params);
    }

    private function getRequestErrors($request)
    {
        $errors = false;

        if(empty(trim($request['origin']))) {
            $errors['required'] = 'Please fill in the origin';
        } elseif(!$this->isValidOrigin($request['origin'])) {
            $errors['invalid'] = 'Please fill in valid origin';
        }

        return $errors;
    }

    private function isValidOrigin($origin)
    {
        //check for 3 letters
        if(strlen($origin) != 3) return false;

        //check for uppercase alphabetic characters
        if(!ctype_upper($origin)) return false;

        //TODO: Add additional IATA code validation here

        return true;
    }
}
