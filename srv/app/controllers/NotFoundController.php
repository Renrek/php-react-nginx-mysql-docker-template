<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Controllers\BaseViewController;


class NotFoundController extends BaseViewController {

    public function index(): void {
        $this->view = 'notFound/index';
        $this->render();
    }
}