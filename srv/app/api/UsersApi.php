<?php declare(strict_types=1);

namespace App\Api;

use App\Libraries\Core\Api;
use App\Services\UserRelationshipServices;

class UsersApi extends Api {

  public function __construct(){
    
  }

  public function list(): void {
    $users = new UserRelationshipServices();
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $this->response(200, $users->getUsers());
  }

  public function get(): void {
    $data = (object) [
      'test' => 'get',
      'number' => 23,
    ];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $this->response(200, $data);
  }

  public function create(): void {
    $data = (object) [
      'test' => 'create',
      'number' => 23,
    ];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $this->response(201, $data);
  }

  public function update(): void {
    $data = (object) [
      'test' => 'update',
      'number' => 23,
    ];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   $this->response(200, $data);
  }

  public function delete(): void {
    $data = (object) [
      'test' => 'delete',
      'number' => 23,
    ];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $this->response(200, $data);
  }
}