<?php declare(strict_types=1);

    namespace App\Libraries\Core;

    use stdClass;

    abstract class Controller
    {

        public function __construct(){       
        }
        //abstract public function index() : void;

        // view figure out a way to dynamically add js scripts based on what is in /srv/public/js by scanning directory due to cache busting

        //TODO accept string and object

        //TODO header and footer requests here.
        public function view(string $view, object|null $data = null) : void 
        {
            if(!isset($data)){
                $data = new stdClass();
            }
            
            if(file_exists('../app/views/pages/'. $view . '.php')){
                //$listOFiles = scandir('/srv/public/js');
                //var_dump($listOFiles);
                $scripts = '<script src="/js/main.js"></script>';
                require_once '../app/views/pages/'. $view . '.php';
            } else {
                die('View does not exist');
            }
        }
    }