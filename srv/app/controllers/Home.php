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
    {
        $test = $_SERVER['REQUEST_METHOD'] ?? null;
        $stuff = ['tis' => 'one', 'echo' => 'who'];
        $numberComponent = new React('number', $stuff);
        $numberComponent = $numberComponent->generateEntry();
        $data = [
            'title' => 'My title',
            'numberComponent' => $numberComponent,
        ];
        
        $this->view('home/index', $data);

        $user = new User(1);
    }

}