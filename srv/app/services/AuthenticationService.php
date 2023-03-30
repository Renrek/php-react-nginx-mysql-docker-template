<?php declare(strict_types=1);

namespace App\Service;

use App\Libraries\Core\Service; 

final class AuthenticationService extends Service {
    
    private string $userEmail;

    public function __construct(string $userEmail) {
        $this->userEmail = $userEmail;
    }

    public function createPassword(string $password) : bool
    {
        $newHash = password_hash($password, PASSWORD_DEFAULT);
        //DB store hash
        //return false; //on fail
        return true; //on success
    }

    public function verifyPassword(string $password) : bool
    {
        $userHash = ''; //DB lookup for userhash in table
        return password_verify($password, $userHash);
    }

    // May go into another home.
    //   function isLoggedIn(){
//     if(isset($_SESSION['userId'])){
//       return true;
//     } else {
//       return false;
//     }
//   }
}