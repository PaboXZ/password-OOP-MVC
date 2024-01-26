<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine{

    private array $globalData = [];

    public function __construct(private string $basePath){

    }

    public function render(string $path, array $data = []){

        extract($data, EXTR_SKIP);
        extract($this->globalData, EXTR_SKIP);
        
        ob_start();

        require $this->resolve($path);

        $output = ob_get_contents();

        ob_end_clean();

        return $output;

    }

    private function resolve(string $path): string {
        return "{$this->basePath}/{$path}";
    }

    public function addGlobalData(string $key, mixed $value){
        $this->globalData[$key] = $value;
    }
}