<?php declare(strict_types=1);

namespace App\Models;

use App\Libraries\Core\DB;

class User
{

    private $db;
    
    public function __construct(){
        $this->db = new DB();
    }
}