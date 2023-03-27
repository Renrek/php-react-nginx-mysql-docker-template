<?php declare(strict_types=1);

namespace App\Api;

use App\Libraries\Core\Api;

class LoginApi extends Api {

  public function index(){
    $test = $_SERVER['REQUEST_METHOD'] ?? null;
    
  }
}