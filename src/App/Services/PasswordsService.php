<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidatorException;

class PasswordsService {

    public function __construct(
        private Database $database
    ){}

    public function add(array $data){
        if($this->database->query("SELECT * FROM passwords WHERE user_id = :userID AND password_name = :passwordName",
        [
            'userID' => $_SESSION['user'],
            'passwordName' => $data['passwordName']
        ])->count())
            throw new ValidatorException(['passwordName' => ["Password {$data['passwordName']} already exists."]]);

        $this->database->query("INSERT INTO passwords (password_name, password_hash, user_id) VALUE (:passwordName, :passwordHash, :user_id)",
        [
            'passwordName' => $data['passwordName'],
            'passwordHash' => $this->createHash(),
            'user_id' => $_SESSION['user']
        ]);
    }

    public function getPasswords(){
        $passwords = $this->database->query("SELECT * FROM passwords WHERE user_id = :userID" , ['userID' => $_SESSION['user']])->findAll();

        $passwords = array_map(function ($password) {
            $password['password'] = $this->getTruePassword($password['password_hash'], $_SESSION['userPassword']);
            return $password;
        }, $passwords);

        return $passwords;
    }

    public function createHash(): string{
        $hash = random_bytes(20);
        $hash = bin2hex($hash);

        return $hash;
    }

    public function getTruePassword(string $passwordHash, string $password){
        $password = crypt($passwordHash . $password, 'salt');
        $password = substr($password, 0, 24);

        return $password;
    }
}