<?php

function dd(mixed $variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}