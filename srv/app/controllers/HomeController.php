<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Controllers\BaseViewController;
use App\Helpers\RedirectHelper;
use App\Helpers\ReactHelper;
use Exception;

use App\Services\AuthenticationService;

class HomeController extends BaseViewController {

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

        $this->data->loginElement = $this->generateReactElement(
            'login', 
            [ 'loggedIn' => $loggedIn]
        );

        $this->data->header = "Header Text";
        $this->render();
    }
}