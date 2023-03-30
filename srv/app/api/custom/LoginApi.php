<?php declare(strict_types=1);

namespace App\Api\Custom;

use App\Libraries\Core\Api;

class LoginApi extends Api {

  public function verify(){
    $test = $_SERVER['REQUEST_METHOD'] ?? null;
    
    $_SESSION['userId'] = 42;
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $this->response(200, ['this' => 'very cool']);
  }

  public function logOut(){
    session_unset();
    session_destroy();
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $this->response(200, ['this' => 'ddd cool']);
  }
}