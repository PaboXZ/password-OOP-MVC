<?php

function dd(mixed $variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function redirectTo(string $path){
    http_response_code(302);
    header("Location: {$path}");
    exit;
}