<?php
spl_autoload_register(function ($className) {
    if (substr($className, 0, strlen(APP_NAMESPACE)) == APP_NAMESPACE) {
        $className = implode(DIRECTORY_SEPARATOR, [
            CLASSPATH,
            substr($className, strlen(APP_NAMESPACE))
        ]);
    } else {
        $className = implode(DIRECTORY_SEPARATOR, [
            CLASSPATH,
            'vendor',
            $className
        ]);
    }

    include_once $className . '.' . PHP_EXT;
});