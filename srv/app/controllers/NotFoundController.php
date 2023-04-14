<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Core\ViewController;


class NotFoundController extends ViewController {

    public function index(): void {
        $this->view = 'notFound/index';
        $this->render();
    }
}