<?php declare(strict_types=1);

    namespace App\Libraries\Controllers;

    use App\Libraries\Controllers\ControllerTrait;
    use App\Libraries\Injection\ContainerTrait;
    use json_encode;

    class BaseApiController
    {
        use ControllerTrait;
        use ContainerTrait;
        // public function __construct(){
        //     $data = (object) [
        //         'test' => 'something',
        //         'number' => 23,
        //     ];
        //     header("Access-Control-Allow-Origin: *");
        //     header("Content-Type: application/json; charset=UTF-8");
        //     header("Access-Control-Allow-Methods: GET");
        //     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        //     $this->response(200, $data);
        // }

        protected function response($code, $data){
            $payload = json_encode($data);
            http_response_code($code);
            echo $payload;
        }

        // list get create update delete
        //library.googleapis.com/shelves/shelf1/books/book2"
    }
