<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Core\Controller;
use App\Helpers\RedirectHelper;
use App\Helpers\ReactHelper;

class HomeController extends Controller {

    public function index(): void 
    {   
        // \session_unset();
        // \session_destroy();
        if(isset($_SESSION)){
        $loggedIn = \array_key_exists('userId', $_SESSION);
        } else {
            $loggedIn = false;
        }
        
        $this->view = 'home/index';
        $this->title .= ' - Welcome';
        $loginElement = new ReactHelper('login', [ 'loggedIn' => $loggedIn]);
        $this->data->loginElement = $loginElement->generateEntry();
        $this->data->header = "Header Text";
        $this->render();
    }
}