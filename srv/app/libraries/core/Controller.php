<?php declare(strict_types=1);

    namespace App\Libraries\Core;

    use App\Helpers\RedirectHelper;
    use stdClass;
    use str_starts_with;
    use str_ends_with;

    abstract class Controller
    {
        protected string $header = 'header.php';
        protected string $footer = 'footer.php';
        protected string $title = SITE_NAME;
        protected string $view;//rename
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
                require_once '../app/views/layout.php';
            } else {
                RedirectHelper::sendToNotFound; //TODO needs love
            }
        }

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