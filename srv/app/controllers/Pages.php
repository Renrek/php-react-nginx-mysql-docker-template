<?php declare(strict_types=1);

    namespace App\Controllers;

    use App\Libraries\Core\Controller;

    class Pages extends Controller {

        public function __construct(){
            
        }

        public function index(){
            $data = [
                'title' => 'My title',
            ];

            $this->view('pages/index', $data);
        }

        public function about(){
            $this->view('pages/about');
        }
    }