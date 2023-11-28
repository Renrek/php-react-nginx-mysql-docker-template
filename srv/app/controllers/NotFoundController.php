<?php declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\Controllers\BaseViewController;
use App\Config\ResponseConst;
use App\Attributes\Routing\Route;
use App\Attributes\Routing\Methods\Get;

#[Route(path: '/not-found')]
class NotFoundController extends BaseViewController {

    #[Get(path: '')]
    public function index(): void {
        http_response_code(ResponseConst::NOT_FOUND);
        $this->render('notFound/index');
    }
}