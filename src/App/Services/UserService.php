<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class UserService {

    public function __construct(private Database $database){

    }

    public function isEmailTaken(string $email){
        return (bool) $this->database->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->count();
    }

    public function isLoginTaken(string $login){
        return (bool) $this->database->query("SELECT * FROM users WHERE login = :login", ['login' => $login])->count();
    }

    public function create(array $data){
        $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->database->query("INSERT INTO users (login, email, password_hash) VALUE (:login, :email, :passwordHash)", [
            'login' => $data['login'],
            'email' => $data['email'],
            'passwordHash' => $passwordHash
        ]);
    }

    public function getUser($data){
        return $this->database->query("SELECT * FROM users WHERE login = :login", ['login' => $data['login']])->find();
    }
}