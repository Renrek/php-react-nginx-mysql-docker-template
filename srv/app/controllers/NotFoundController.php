<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Core\Controller;


class NotFoundController extends Controller {

    public function index(): void {
        $this->view = 'notFound/index';
        $this->render();
    }
}