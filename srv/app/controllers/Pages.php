<?php declare(strict_types=1);

    namespace App\Controllers;

    use App\Libraries\Core\Controller;
    use App\Libraries\Helpers\Redirect;

    class Pages extends Controller {

        public function __construct(){
            
        }

        public function index(): void 
        {
            $test = $_SERVER['REQUEST_METHOD'] ?? null;
            
            $data = [
                'title' => 'My title',
            ];
            
            $this->view('pages/index', $data);
        }

        public function about(): void 
        {
            $this->view('pages/about');
        }

        public function notFound(): void
        {
            $this->view('pages/notFound');
        }
    }