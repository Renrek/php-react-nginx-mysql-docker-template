<?php declare(strict_types=1);

namespace App\Libraries\Core;

use App\Config\DatabaseConst;
use App\Libraries\Core\DB;
use AllowDynamicProperties;

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
        $statement = 'UPDATE '.$this->table.' SET '.$this->updateFields().' WHERE '.$this->primaryKey.' = '.$this->$primaryKey;
        $this->db->run($statement, $this->updateValues());
    }

    public function remove(int $primaryKey) : void { // May want to convert this to soft delete.
        $statement = 'DELETE FROM '.$this->table.' WHERE '.$this->primaryKey.' = ?';
        $this->db->run($statement, $primaryKey);
    }

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

    protected function updateValues(): array {
        $values = [];
        $fields = $this->fields;
        $key = array_search($this->primaryKey, $fields);
        if($key !== false){
            unset($fields[$key]);
        }
        foreach ($fields as $value) {
            $values[] = $this->$value;
        }
        return $values;
    }
}