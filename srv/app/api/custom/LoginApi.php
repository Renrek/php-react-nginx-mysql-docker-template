<?php declare(strict_types=1);

namespace App\Api\Custom;

use App\Libraries\Core\Api;

class LoginApi extends Api {

  public function verify(){
    $test = $_SERVER['REQUEST_METHOD'] ?? null;
    var_dump('hi');
  }
}