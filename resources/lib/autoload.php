<?php

/**
 * Autoloader for PayoneApi library (no composer.json or vendor needed for this namespace).
 * Dependencies (e.g. Guzzle) are loaded from vendor/ when present (e.g. SDK symlink).
 */

$payoneApiBaseDir = __DIR__ . '/PayoneApi/';

spl_autoload_register(function ($class) use ($payoneApiBaseDir) {
    $prefix = 'PayoneApi\\';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relativeClass = substr($class, $len);
    $file = $payoneApiBaseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (is_file($file)) {
        require $file;
    }
});
