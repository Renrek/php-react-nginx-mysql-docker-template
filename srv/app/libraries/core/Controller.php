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

        // view figure out a way to dynamically add js scripts based on what is in /srv/public/js
        public function view(string $view, array $data = []) : void 
        {
            if(file_exists('../app/views/'. $view . '.php')){
                $listOFiles = scandir('/srv/public/js');
                var_dump($listOFiles);
                $scripts = '<script src="/js/main.80118490f21a7dde55cc.js"></script>';
                require_once '../app/views/'. $view . '.php';
            } else {
                die('View does not exist');
            }
        }
    }