<?php

declare(strict_types=1);

namespace App\Controllers;
use Framework\TemplateEngine;
use App\Config\Paths;

class HomeController{

    private TemplateEngine $templateEngine;

    public function __construct() {
        $this->templateEngine = new TemplateEngine(Paths::VIEW);
    }

    public function home() {
        echo $this->templateEngine->render('index.php');
    }
}