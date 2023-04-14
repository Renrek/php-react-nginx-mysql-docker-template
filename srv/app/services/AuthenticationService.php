<?php declare(strict_types=1);

namespace App\Services;

use App\Libraries\Core\Service; 
use App\Models\UserModel;
use App\Attribute\DependencyInjector;
use App\Libraries\Container\Container;

//#[DependencyInjector]
final class AuthenticationService extends Service {
    
    private string $userEmail;

    public function __construct() {}
    
    public function setEmail(string $userEmail) {
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
        $userModel = (new Container)->get(UserModel::class);
        $user = $userModel->getByEmail($this->userEmail);
        return password_verify($password, $user->passwordHash);
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