<?php declare(strict_types=1);

namespace App\Models;


use App\Libraries\Core\Model;
use App\Libraries\Core\DB;

class UserModel extends Model
{ 
    public function __construct()
    {
        $this->db = new DB();
        $this->table = 'user';
        $this->primaryKey = 'id';
        $this->publicFields = ['id', 'email', 'firstName', 'lastName', 'createdAt', 'updatedAt'];
    }

    public function getAllByEmail(string $email) : array
    {   
        $statement = $this->selectPrefix() . 'WHERE email = ?';
        return $this->db->run($statement, [$email])->fetchAll();
    }
}



 