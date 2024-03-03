<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\PasswordsService;
use Framework\TemplateEngine;

class PanelController {
    
    public function __construct(
        private TemplateEngine $view,
        private PasswordsService $passwordsService
        ){

    }

    public function view(){
        $passwords = $this->passwordsService->getPasswords();
        
        $this->view->addGlobal('passwords', $passwords);

        echo $this->view->render('index.php');
    }
}