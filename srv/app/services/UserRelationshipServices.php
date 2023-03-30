<?php declare(strict_types=1);

namespace App\Services;

use App\Libraries\Core\Service;
use App\Libraries\Core\DB;
use App\Models\UserModel;


class UserRelationshipServices extends Service {

    public function __construct(){
        
    }

    public function getUsers(){
        $db = new DB();
        $users = new UserModel();
        return $users->getAll();
    }
}