<?php declare(strict_types=1);

namespace App\Models;

use App\Libraries\Core\DB;
use App\Libraries\Core\Model;

class User extends Model
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;

    private DB $db;
    private string $table = 'user';
    
    public function __construct(?int $id){
        $this->db = new DB();

        if (isset($id)){
            $this->lookupById($id);
        }
    }

    public function lookupById(int $id) : void
    {
        $statement = 'SELECT id, email, firstName, lastName, password FROM '.$this->table.' WHERE id = ?';
        $thing = $this->db->run($statement, [$id])->fetch();
    }

    public function lookupByEmail(string $email) : void
    {   
        $statement = 'SELECT id, email, firstName, lastName, password FROM '.$this->table;
        $thing = $this->db->run($statement)->fetchAll();
    }
}