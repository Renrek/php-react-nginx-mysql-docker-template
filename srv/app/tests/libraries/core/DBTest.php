<?php declare(strict_types=1);

namespace App\Tests\Libraries\Core;

use PHPUnit\Framework\TestCase;
use App\Libraries\Core\DB;

final class DBTest extends TestCase
{
    public function tryTest(){
        $db = new DB();
        $thing = $db->pdo;
    }


        // use App\Libraries\Core\DB;
        // $db = new DB();
        // $thing = $db->run('SELECT id, name FROM new_table');
        // foreach ($thing as $t){
        //     var_dump($t->name);
        // }
}