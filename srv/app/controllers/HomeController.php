<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Controllers\BaseViewController;

use App\Services\AuthenticationService;
use App\Attributes\Routing\Route;
use App\Attributes\Routing\Methods\Get;
use App\Attributes\Routing\Methods\Post;

#[Route(path: "")]
class HomeController extends BaseViewController {

    #[Get(path: "/")]
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

    #[Get(path: "/{id:int}/boondock/{thing}/stuff/{reallyThree}")]
    public function boodock(): void 
    {   
        $data = (object) [];
        
        echo 'psst';
        $this->render('notFound/index', $data, 'Welcome');
    }

    #[Post(path: "/special")]
    public function handleUpdate()
    {
        echo 'not it';
    }

    #[Post(path: "/test/{firstParam}")]
    public function handlePractice($firstParam)
    {
        echo 'not it';
    }
}