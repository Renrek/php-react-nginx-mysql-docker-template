<?php declare(strict_types=1);

namespace App\Models;

use App\Libraries\Core\Model;
use App\Libraries\Core\DB;

class UserModel extends Model
{ 
    public function __construct()
    {
        $this->db = new DB;
        $this->table = 'user';
        $this->primaryKey = 'id';
        $this->publicFields = ['id', 'email', 'firstName', 'lastName', 'createdAt', 'updatedAt'];
    }

    public function getAll() : array
    {   
        $statement = $this->selectPrefix();
        return $this->db->run($statement, [])->fetchAll();
    }

    public function getByEmail(string $email):object {
        $this->publicFields[] = 'passwordHash';
        $statement = $this->selectPrefix() . ' WHERE email = ?';
        return $this->db->run($statement, [$email])->fetch();
    }
}
