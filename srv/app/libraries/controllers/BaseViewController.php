<?php declare(strict_types=1);

    namespace App\Libraries\Controllers;

    use App\Helpers\RedirectHelper;
    use App\Exceptions\ViewNotFoundException;
    use App\Libraries\Controllers\ControllerTrait;
    use App\Libraries\Injection\ContainerTrait;
    use str_starts_with;
    use str_ends_with;

    class BaseViewController
    {
        use ControllerTrait;
        use ContainerTrait;

        protected string $header = 'header.php';
        protected string $footer = 'footer.php';
        protected string $title = SITE_NAME;
        protected string $view;
        protected object $data;

        public function __construct(){  
            $this->data = (object) [];   
        }
     
        public function render() : void 
        {          
            if(file_exists('../app/views/pages/'. $this->view . '.php')){
                $title = $this->title;
                $data = $this->data;
                $headerPath = APP_ROOT . '/views/include/'.$this->header;
                $footerPath = APP_ROOT . '/views/include/'.$this->footer;
                $view = $this->view;
                [$scripts, $styles] = $this->lookupAssets();
                require_once '/srv/app/views/layout.php';
            } else {
                throw new ViewNotFoundException();
            }
        }

        // If load times ever get passed 500ms this will be a good candidate for 
        // including within a build-step
        private function lookupAssets(): array {
            $scripts = '';
            $styles = '';
            $files = scandir('/srv/public/assets');
            foreach ($files as $file){
                if(str_starts_with($file, 'main.') && str_ends_with($file, '.css')){
                    $styles .= '<link rel="stylesheet" href="/assets/'.$file.'">';
                }
                if(str_starts_with($file, 'main.') && str_ends_with($file, '.js')){
                    $scripts .= '<script src="/assets/'.$file.'"></script>';
                }
            }
            return [$scripts, $styles];
        }
    }