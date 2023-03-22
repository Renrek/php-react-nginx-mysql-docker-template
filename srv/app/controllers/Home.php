<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Core\Controller;
use App\Libraries\Helpers\Redirect;
use App\Libraries\Helpers\React;

//temp
use App\Models\User;

class Home extends Controller {

    public function __construct(){
        
    }

    public function index(): void 
    {   //$user = new User(1);
        //$test = $_SERVER['REQUEST_METHOD'] ?? null;
        $loginElement = new React('login');

        $data = [
            'title' => 'My title',
            'loginElement' => $loginElement->generateEntry(),
        ];
        
        $this->view('home/index', $data);

        
    }

}