<?php

namespace Com\FernandezFran\Core;

use Steampixel\Route;

class FrontController{

    static function main(){
        Route::add('/',
                function(){
                    $controlador = new \Com\FernandezFran\Controllers\InicioController();
                    $controlador->index();
                }
                , 'get');

        Route::add('/formulario',
                function(){
                    $controlador = new \Com\FernandezFran\Controllers\FormularioExamenController();
                    $controlador->mostrarFormulario();
                }
                , 'get');

        Route::run();
    }
}

