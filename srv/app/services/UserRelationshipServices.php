<?php declare(strict_types=1);

namespace App\Services;

use App\Libraries\Core\Service;
use App\Libraries\Core\DB;
use App\Models\UserModel;


class UserRelationshipServices extends Service {

    private DB $db;
    public function __construct(
       // DB $db,
    ){
       // $this->db = $db;
    }

    public function tempTest(){
        var_dump('in here!');
    }

    public function getUsers(){
        $db = new DB();
        $users = new UserModel();
        return $users->getAll();
    }
}