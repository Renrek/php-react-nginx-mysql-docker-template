<?php declare(strict_types=1);

    namespace App\Libraries\Core;

    class Controller
    {
        // require and return model object
        public function model(string $model) : object {
            require_once '../app/models/'. $model . '.php';
            return new $model();
        }

        //
        public function view(string $view, array $data = []) : void {
            if(file_exists('../app/views/'. $view . '.php')){
                require_once '../app/views/'. $view . '.php';
            } else {
                die('View does not exist');
            }
        }
    }