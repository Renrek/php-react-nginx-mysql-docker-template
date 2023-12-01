<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Controllers\BaseViewController;

use App\Services\AuthenticationService;
use App\Attributes\Routing\Route;
use App\Attributes\Routing\Methods\Get;
use App\Attributes\Routing\Methods\Post;

#[Route(path: "")]
class HomeController extends BaseViewController {

    #[Get(path: "")]
    #[Get(path: "/special")]
    public function index(): void 
    {   
        $data = (object) [];

        $data->header = "Header Text";

        $data->csrfTokenFormElement = $this->generateCsrfFormElement();

        if(isset($_SESSION)){
            $loggedIn = \array_key_exists('userId', $_SESSION);
        } else {
            $loggedIn = false;
        }
        
        $data->loginElement = $this->generateReactElement(
            'authentication', 
            [ 
                'loggedIn' => $loggedIn,
            ]
        );

        $this->render('home/index', $data, 'Welcome');
    }

    

    #[Get(path: "/test/{firstParam:string}/something/{secondParam}")]
    public function handlePractice($firstParam, $secondParam)
    {
        echo 'first Param: '. $firstParam;
        echo 'second Param: '. $secondParam;
    }
}