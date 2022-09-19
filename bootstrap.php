<?php

declare(strict_types=1);

$handler = function ($className) {

    $nameParts = explode('\\', $className);
    unset($nameParts[0]);
    $classPath = './src';
    foreach ($nameParts as $part) {
        $classPath .= '/' . $part;
    }

    require $classPath . '.php';
};

spl_autoload_register($handler);

// cia yra auto loader, kuris automatiskai kviecia kitus duomenis