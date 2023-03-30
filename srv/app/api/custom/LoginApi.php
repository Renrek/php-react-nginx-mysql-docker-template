<?php declare(strict_types=1);

namespace App\Api\Custom;

use App\Libraries\Core\Api;
use App\Services\AuthenticationService;

class LoginApi extends Api {

  public function verify(){
    $test = $_SERVER['REQUEST_METHOD'] ?? null;
    $body = json_decode(file_get_contents('php://input'));
    $authService = new AuthenticationService($body->email);
    $isLoggedin = $authService->verifyPassword($body->password); 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $this->response(200, ['loggedIn' => $isLoggedin]);
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