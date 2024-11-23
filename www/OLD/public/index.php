<?php
require '../vendor/autoload.php';

try{
    $dotenv = Dotenv\Dotenv::createImmutable('../');
    $dotenv->load();
    Com\FernandezFran\Core\FrontController::main();
} catch (Exception $e) {
    if($_ENV['app.debug']){
        throw $e;
    }
    else{
        echo $e->getMessage();
    }
}
