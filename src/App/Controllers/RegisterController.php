<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class RegisterController {

    public function __construct(private TemplateEngine $templateEngine){
    }

    public function register(){
        echo $this->templateEngine->render('register.php');
    }
}