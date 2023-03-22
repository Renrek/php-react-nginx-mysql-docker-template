<?php declare(strict_types=1);

namespace App\Libraries\Helpers;


final class React
{
    private string $componentName;
    private array $data = [];


    public function __construct(string $componentName, array $data = []){
        $this->componentName = $componentName;
        if (!empty($data)){
            $this->data = $data;
        }
    }

    public function generateEntry() :string {
        $parameters = base64_encode(json_encode($this->data));
        return '<div class="react-component" data-component="'.$this->componentName.'" data-parameters="'.$parameters.'"></div>';
    }

}