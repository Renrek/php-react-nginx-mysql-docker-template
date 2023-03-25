<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Core\Controller;
use App\Helpers\RedirectHelper;
use App\Helpers\ReactHelper;
use stdClass;

//temp for testing
use App\Models\UserModel;
use App\Models\UserStruct;

class HomeController extends Controller {

    public function __construct(){
    }

    public function index(): void 
    {   
        
        
        $loginElement = new ReactHelper('login');

        $data = new stdClass();
        $data->title = 'Welcome';
        $data->loginElement = $loginElement->generateEntry();

        $this->view('home/index', $data);
    }
}