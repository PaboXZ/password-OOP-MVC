<?php

declare(strict_types=1);

namespace Framework;
use \PDO;
use PDOException;

class Database {
    private PDO $connection;

    public function __construct(string $driver, array $config, string $username, string $password){
        
        $config = http_build_query($config, arg_separator: ';');

        $dsn = $driver . ':' . $config;
        
        try{
            $this->connection = new PDO($dsn, $username, $password);
        }
        catch(PDOException $e){
            exit("Server unaviable");
        }
    }
    
}