<?php declare(strict_types=1);

namespace App\Libraries\Core;

// Takes the submitted url and uses it to control the framework
//Example domain.com/controller/method/param/param/param/

Class Router {

    // Defaults directs to home page should a controller not exist
    // TODO Fix controller and method to not be mixed, set as mixed to accommodate legacy code.
    protected mixed $currentController = 'Pages';
    protected mixed $currentMethod = 'index';
    protected array $params = [];

    public function __construct(){

        $url = $this->getUrl();

        // Check if controller child class exists, if so set it as current
        if(file_exists('../app/controllers/' . ucwords($url[0]) .'.php')){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        $file = '../app/controllers/' . $this->currentController . '.php';

        // Ensure that the path provided was 
        if (str_starts_with(realpath($file), '/srv/app/controllers/')){
            // Call class by full namespace name 
            $class = 'App\\Controllers\\'. $this->currentController;
            // Instantiate the controller
            $this->currentController = new $class;
        }

        // Check for method if not, all controllers should have an index method.
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // Set what is left of the array as params, controller and method should
        // be removed.
        $this->params = $url ? array_values($url) : [];

        // callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    // Returns an array of the url broken down into an array
    // [ controller, method, param, param ... ]
    public function getUrl(){
        if(isset($_SERVER['REQUEST_URI'])){
            $url = rtrim(ltrim($_SERVER['REQUEST_URI'], '/'));
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);;
        }
    }

}