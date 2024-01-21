<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class RegisterController {

    private TemplateEngine $templateEngine;

    public function __construct(){
        $this->templateEngine = new TemplateEngine(Paths::VIEW);
    }

    public function register(){
        echo $this->templateEngine->render('register.php');
    }
}