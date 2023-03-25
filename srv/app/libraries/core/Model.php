<?php declare(strict_types=1);

namespace App\Libraries\Core;

use App\Config\DatabaseConst;
use App\Libraries\Core\DB;
use AllowDynamicProperties;
use property_exists;

#[AllowDynamicProperties]
 class Model {
    
    protected DB $db;
    protected string $table;
    protected string $primaryKey;
    protected string $schema = DatabaseConst::NAME;
    protected array $fields;

    public function __construct() 
    {
        $this->db = new DB();
    }
 
    public function new() : void {
        foreach ($this->fields as $fieldName) {
            $this->$fieldName = NULL;
        }
    }
    public function save() : void {
        $primaryKey = $this->primaryKey;
        //use this to validate.
        //property_exists(__CLASS__, 'name');
        $statement = 'UPDATE '.$this->table.' SET '.$this->updateFields().' WHERE '.$this->primaryKey.' = '.$this->$primaryKey;
        var_dump($statement);
    }

    public function remove() : void {}

    public function getByPrimaryKey(int $primaryKey): void {

        $statement = 'SELECT '. $this->selectFields() .' FROM user WHERE '.$this->primaryKey.' = ?';
        $returnedFields = $this->db->run($statement, [$primaryKey])->fetch();
        foreach ($returnedFields as $key => $value) {
            $this->$key = $value;
        }
    }

    protected function selectFields(): string {
        return implode(', ', $this->fields);
    }

    protected function updateFields(): string {
        $fields = $this->fields;
        $key = array_search($this->primaryKey, $fields);
        if($key !== false){
            unset($fields[$key]);
        }
        return implode(' = ?, ', $fields) . ' = ?';
    }

    
}