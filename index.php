<?php

include 'vendor/autoload.php';

$DI = new Src\DependencyInjector();

$DI->registerService('logger', function($di){
    // create a log channel
    $log = new Monolog\Logger('name');
    $log->pushHandler(new Monolog\Handler\StreamHandler('logger.log', Monolog\Logger::WARNING));

     return $log;
});

$DI->registerService('db', function($container){
    $obj = new stdClass();
    $obj->name = 'DI_LOG';
    $container->getService('logger')->warning('Foo');
    return $obj;
});
echo '<pre>';
$DI->getService('db');

