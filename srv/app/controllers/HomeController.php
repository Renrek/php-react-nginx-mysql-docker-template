<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Core\Controller;
use App\Helpers\RedirectHelper;
use App\Helpers\ReactHelper;
use Exception;

use App\Libraries\Container\Container;
use App\Services\AuthenticationService;

class HomeController extends Controller {

    public function index(): void 
    {   

        // $test = (new Container())->get(AuthenticationService::class);
        // $test->setEmail('bob@bob.com');
        
        // \session_unset();
        // \session_destroy();
        if(isset($_SESSION)){
        $loggedIn = \array_key_exists('userId', $_SESSION);
        } else {
            $loggedIn = false;
        }
        
        //trigger_error('My special error', E_USER_ERROR);
        
        $this->view = 'home/index';
        $this->title .= ' - Welcome';
        $loginElement = new ReactHelper('login', [ 'loggedIn' => $loggedIn]);
        $this->data->loginElement = $loginElement->generateEntry();
        $this->data->header = "Header Text";
        $this->render();
    }
}