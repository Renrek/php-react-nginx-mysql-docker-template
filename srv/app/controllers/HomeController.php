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

        $user = new UserModel();
        // $user->lookupById(id: 1);
        $user->getByPrimaryKey(1);
        // $user->email =  'adam.savage@mail.com';
        // $user->firstName = 'Adam';
        // $user->lastName = 'Savage';
        // $user->passwordHash = password_hash('secret', PASSWORD_DEFAULT);
        var_dump($user);
        $user->save();

        $data = new stdClass();
        $data->title = 'Welcome';
        $data->loginElement = $loginElement->generateEntry();

        $this->view('home/index', $data);
    }
}