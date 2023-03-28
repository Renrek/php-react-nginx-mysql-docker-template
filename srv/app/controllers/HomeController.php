<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Core\Controller;
use App\Helpers\RedirectHelper;
use App\Helpers\ReactHelper;

class HomeController extends Controller {

    public function index(): void 
    {   
        $this->view = 'home/index';
        $this->title .= ' - Welcome';
        
        $loginElement = new ReactHelper('login');
        $this->data->loginElement = $loginElement->generateEntry();
        $this->data->header = "Header Text";

        $this->render();
    }
}