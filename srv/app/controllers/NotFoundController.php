<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Core\Controller;


class NotFoundController extends Controller {

    public function __construct(){
        
    }

    public function index(): void 
    {
        //$test = $_SERVER['REQUEST_METHOD'] ?? null;
        
        $data = [
            'title' => 'My title',
        ];
        // need to change how this works, end up to this controller with out changing url and redirect.
        //http_response_code(404);
        $this->view('notFound/index');
    }

}