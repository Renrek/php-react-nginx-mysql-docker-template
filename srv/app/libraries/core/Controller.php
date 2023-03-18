<?php declare(strict_types=1);

    namespace App\Libraries\Core;

    abstract class Controller
    {
        //abstract public function index() : void;

        // require and return model object
        // this needs to be moved to a BaseService controller
        public function model(string $model) : object 
        {
            require_once '../app/models/'. $model . '.php';
            return new $model();
        }

        // view
        public function view(string $view, array $data = []) : void 
        {
            if(file_exists('../app/views/'. $view . '.php')){
                require_once '../app/views/'. $view . '.php';
            } else {
                die('View does not exist');
            }
        }
    }