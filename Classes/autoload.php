<?php
spl_autoload_register(static function(string $fqcn) {

    $segments = explode('\\', $fqcn);
    $className = end($segments);
    
    if ($segments[0] === 'Classes') {
        // Si c'est dans le namespace Classes :
        $path = __DIR__ . '/' . $className . '.php';
    } elseif ($segments[0] === 'BD') {
        // Si c'est dans le namespace BD :
        $path = __DIR__ . '/BD/' . $className . '.php';
    }
    
    require_once $path;
});