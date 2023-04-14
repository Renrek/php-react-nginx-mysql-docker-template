<?php declare(strict_types=1);

namespace App\Libraries\Core;

use App\Config\DatabaseConst;
use PDO;

Class DB 
{

    public PDO $pdo;

    public function __construct()
    {
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,// PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
       
        $dsn = "mysql:host=".DatabaseConst::HOST.";dbname=".DatabaseConst::NAME.";port=".DatabaseConst::PORT.";charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, DatabaseConst::USER, DatabaseConst::PASS, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function run(string $sql, $args = NULL)
    {
        if (!$args)
        {
            return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}