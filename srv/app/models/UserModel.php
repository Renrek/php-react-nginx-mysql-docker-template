<?php declare(strict_types=1);

namespace App\Models;


use App\Libraries\Core\Model;


class UserModel extends Model
{ 
    
    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
        $this->primaryKey = 'id';
        $this->fields = ['id', 'email', 'firstName', 'lastName', 'passwordHash', 'createdAt', 'updatedAt'];
    }

    public function lookupByEmail(string $email) : void
    {   
        $statement = 'SELECT id, email, firstName, lastName, passwordHash FROM '.$this->table.' WHERE email = ?';
        $thing = $this->db->run($statement, [$email])->fetch();
    }

    
}



 