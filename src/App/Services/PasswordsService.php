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

        $this->database->query("INSERT INTO passwords (password_name, password_hash, user_id, password_color) VALUE (:passwordName, :passwordHash, :userID, :passwordColor)",
        [
            'passwordName' => $data['passwordName'],
            'passwordHash' => $this->createHash(),
            'userID' => $_SESSION['user'],
            'passwordColor' => '666'
        ]);
    }

    public function delete(string $passwordID){
        if(!$this->database->query("SELECT * FROM passwords WHERE user_id = :userID AND id = :passwordID",
        [
            'userID' => $_SESSION['user'],
            'passwordID' => $passwordID
        ])->count())
            redirectTo('/');

        $this->database->query("DELETE FROM passwords WHERE id = :passwordID",
        [
            'passwordID' => $passwordID
        ]);

    }

    public function getPasswords(){
        $passwords = $this->database->query("SELECT * FROM passwords WHERE user_id = :userID" , ['userID' => $_SESSION['user']])->findAll();

        $passwords = array_map(function ($password) {
            $password['password'] = $this->generatePassword($_SESSION['userPassword'], $password['password_hash'], 50);
            return $password;
        }, $passwords);

        return $passwords;
    }

    public function createHash(): string{
        $hash = random_bytes(20);
        $hash = bin2hex($hash);

        return $hash;
    }

    public function generatePassword($password, $hash, $cost, $valuesArray = []){
            
        $passwordLength = strlen($password);
        if($passwordLength > 23)
            $passwordLength = 20;

        $sum = 0;

        for($i = 0; $i < $passwordLength; $i++){
            $sum += ord($password[$i]);
        }

        $shuffled = [];
        $counter = 0;
        while(count($shuffled) < 20){
            if($counter < $passwordLength)
                $counter = $counter + 23;
            else{
                $shuffled[] = $password[$counter % $passwordLength]; 
                $counter = $counter % $passwordLength;
            }
        }

        $shuffled = array_map(function ($char) { 
            $char = ord($char);
            if($char >= 65 && $char <= 90)
                $char = $char - 64;
            else{
                if($char >= 97 && $char <= 122)
                    $char = $char - 96 + 26;
                else{
                    if($char >= 48 && $char <= 57)
                        $char = $char - 47 + 52;
                    else {
                        $char = ($char % 5) + 62;
                    }
                }
            return $char;
            }
        }, $shuffled);

        $numbers = [2, 3, 5, 7,	11, 3, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71];
        $numbers2 = [179,181,191,193,197,199,211,223,227,229,233,239,241,251,257,263,269,271,277,281];
        $picked = 0;
        $index = 0;
        for($i = 0; $i < 20; $i++){
            if(in_array($shuffled[$i], $numbers)){
                if($shuffled[$i] > $picked)
                    $index = $i;
                    $picked = $shuffled[$i];
            }
        }

        $newArray = [];

        for($i = 0; $i < 20; $i++){
            if($index < 19)
                $index++;

            $j = $i + 1;
            if($i == 19)
                $j = 0;
            $newArray[] = ((($shuffled[$i] + $shuffled[$j] + $sum) * ord($hash[$i]) + $numbers[$index] % $numbers2[$index]) ) % 67;
        }


        $newArray = array_map(function ($char) { 
            $special = ['@', '#', '$', '!', '&'];
            if($char >= 1 && $char <= 26){
                $char = $char + 64;
                $char = chr($char);
            }
            else{
                if($char >= 27 && $char <= 52){
                    $char = $char + 70;
                    $char = chr($char);
                }
                else{
                    if($char >= 53 && $char <= 62){
                        $char = $char - 5;
                        $char = chr($char);
                    }
                    else {
                        $char = ($char % 5);
                        $char = $special[$char];
                    }
                }
            }
            return $char;
        }, $newArray);

        $newPassword = implode('', $newArray);

        if($cost > 0){
            $cost--;
            $newPassword = $this->generatePassword($newPassword, $hash, $cost, $valuesArray);
        }
        return $newPassword;
    }

    public function regeneratePassword(string $passwordID){
        $newHash = $this->createHash();

        $this->database->query("UPDATE passwords SET password_hash = :newHash WHERE id = :passwordID AND user_id = :userID", [
            'newHash' => $newHash,
            'passwordID' => $passwordID,
            'userID' => $_SESSION['user']
        ]);
        redirectTo('/');
    }

    public function editPasswordName(string $newName, string $passwordID){
        if($this->database->query("SELECT * FROM passwords WHERE user_id = :userID AND password_name = :passwordName",
        [
            'userID' => $_SESSION['user'],
            'passwordName' => $newName
        ])->count())
            throw new ValidatorException(['passwordName' => ["Password {$newName} already exists."]]);

        $this->database->query("UPDATE passwords SET password_name = :newName WHERE id = :passwordID AND user_id = :userID", [
            'newName' => $newName,
            'passwordID' => $passwordID,
            'userID' => $_SESSION['user']
        ]);
    }

    public function editPasswordColor(string $newColor, string $passwordID){
        if(!$this->database->query("SELECT * FROM passwords WHERE user_id = :userID",
        [
            'userID' => $_SESSION['user']
        ])->count())
            redirectTo('/');

        $this->database->query("UPDATE passwords SET password_color = :newName WHERE id = :passwordID AND user_id = :userID", [
            'newName' => $newColor,
            'passwordID' => $passwordID,
            'userID' => $_SESSION['user']
        ]);
    }
}
