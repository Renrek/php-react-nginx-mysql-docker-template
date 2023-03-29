<?php declare(strict_types=1);

namespace App\Libraries\Core;

use App\Config\RouterConst;
use App\Helpers\RedirectHelper;
use http_response_code;

// Takes the submitted url and uses it to control the framework

// Webpage Example: domain.com/controller/method/param/param/param/
// [ controller, method, param, param, param, param, ... ]

// Standard REST API Example: domain.com/api/thing/3/subThing/4/subSubThing/5
// [ 'api', object, objectId, childObject, childObjectId, ...]
// localhost/api/v1/rest/users/

// Custom API
// localhost/api/v1/custom/class/method
    
Class Router 
{
    private array $uri = []; 
    private string $class = RouterConst::CONTROLLER_NAMESPACE
        . RouterConst::DEFAULT_CONTROLLER_PREFIX 
        . RouterConst::CONTROLLER_SUFFIX;
    private string $method = RouterConst::DEFAULT_CONTROLLER_METHOD;
    private array $params = [];

    public function __construct(){

        $this->setUri();
        if($this->uri[0] === 'api'){
            $this->loadApi();
        } else {
            $this->loadController();
        }
    }

    private function loadApi(){
        $isStandardApi = false;
        // Remove 'api' from path
        array_shift($this->uri);

        // Remove 'v1' from path after validation
        if ($this->uri[0] !== 'v1'){
            http_response_code(404);
            die();
        } 
        array_shift($this->uri);

        // Remove 'rest' or 'custom' from path after validation
        if ($this->uri[0] === 'rest') {
            $isStandardApi = true;
        } else if ($this->uri[0] !== 'custom'){
            http_response_code(404);
            die();
        }
        array_shift($this->uri);

        // Make sure there is something left to process
        if (empty($this->uri)){
            http_response_code(404);
            die();
        }

        $file = $isStandardApi 
            ? RouterConst::STANDARD_API_PATH 
            : RouterConst::CUSTOM_API_PATH;

        $file .= ucwords($this->uri[0]) . RouterConst::API_SUFFIX . '.php';
        
        if (!realpath($file)){
            http_response_code(404);
            die('No Go');
        }
        
        $this->class = $isStandardApi 
            ? RouterConst::STANDARD_API_NAMESPACE 
            : RouterConst::CUSTOM_API_NAMESPACE;

        $this->class .= ucwords($this->uri[0]) . RouterConst::API_SUFFIX;

        array_shift($this->uri);

        if($isStandardApi){
            
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($this->uri[0])){
                $this->method = 'get';
            } else { 
                // If no id is provided run basic requests 
                $this->method = match ($_SERVER['REQUEST_METHOD']){
                    'GET' => 'list',
                    'POST' => 'create',
                    'PUT' => 'update',
                    'DELETE' => 'delete',
                };
            }

        } else {
            $this->method = $this->uri[0];
            array_shift($this->uri);
        }

        call_user_func_array([new $this->class, $this->method], [$this->uri]);
    }

    private function loadController(){

        // Go to default page if only domain is provided.
        if(empty($this->uri[0])){
            $this->callController();
            return;
        }

        $file = RouterConst::CONTROLLERS_PATH 
            . ucwords($this->uri[0]) 
            . RouterConst::CONTROLLER_SUFFIX . '.php';

        // Sanitize controller file path
        if (!realpath($file)){
            RedirectHelper::sendToNotFound();
        } 

        $this->class = RouterConst::CONTROLLER_NAMESPACE 
            . ucwords($this->uri[0]) 
            . RouterConst::CONTROLLER_SUFFIX;

        unset($this->uri[0]);

        // All Controllers must have index method by default
        // If a method is not set by user, use controller default
        if(isset($this->uri[1])){
            $this->method = $this->uri[1];
            unset($this->uri[1]);   
        }

        // If a method was provided but does not exists show not found
        if (!method_exists(new $this->class, $this->method)){
            RedirectHelper::sendToNotFound();
        }
        
        // Anything remaining in the array is used as params
        $this->params = $this->uri ? array_values($this->uri) : [];
        
        // Make sure that the real path ends up within controller directory
        if (str_starts_with($file, RouterConst::CONTROLLERS_PATH)){
            $this->callController();
        } else {
            RedirectHelper::sendToNotFound();
        }
        
    }

    // Returns an array of the url broken down into an array of uri elements
    private function setUri(): void
    {
        if(isset($_SERVER['REQUEST_URI'])){
            $uri = rtrim(ltrim($_SERVER['REQUEST_URI'], '/'));
            $uri = filter_var($uri, FILTER_SANITIZE_URL);
            $this->uri = explode('/', $uri);;
        }

        //Potential point of clean up, quick and dirty prototyping.
        if(isset($this->uri[0])){
            //TODO convert not-found to notFound, consider build step? 
            // Currently converts not-found to notfound
            $this->uri[0] = str_replace('-', '', $this->uri[0]);
        }

        if(isset($this->uri[1])){
            //TODO convert not-found to notFound, consider build step? 
            // Currently converts not-found to notfound
            $this->uri[1] = str_replace('-', '', $this->uri[1]);
        }
    }
    
    private function callController(): void
    {
        call_user_func_array(
            [new $this->class, $this->method], 
            $this->params
        );
    }
}