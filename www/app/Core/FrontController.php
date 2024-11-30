<?php

namespace Com\FernandezFran\Core;

use Steampixel\Route;

class FrontController
{

  static function main()
  {
    Route::add('/',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\InicioController();
        $controlador->index();
      }
      , 'get');

    Route::pathNotFound(
      function () {
        $controller = new \Com\FernandezFran\Controllers\ErroresController();
        $controller->error404();
      }
    );



    Route::add('/registro', function () {
      $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
      $controlador->mostrarRegistro();
    }, 'get');

    Route::add('/registro', function () {
      $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
      $controlador->mostrarRegistro();
    }, 'post');




    Route::add('/login', function () {
      $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
      $controlador->mostrarLogin();
    }, 'get');

    Route::add('/login', function () {
      $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
      $controlador->mostrarLogin();
    }, 'post');





    Route::add('/usuarios',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->mostrarTodos();
      }
      , 'get');
    Route::add('/productos',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\ProductoController();
        $controlador->mostrarTodosLista();
      }
      , 'get');
    Route::add('/pedidos',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\PedidoController();
        $controlador->mostrarTodos();
      }
      , 'get');
    Route::add('/productos/card',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\ProductoController();
        $controlador->mostrarTodos();
      }
      , 'get');
    Route::add('/usuarios/ordered',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->mostrarTodosOrdenados();
      }
      , 'get');

    Route::add('/usuarios/estandard',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->mostrarUsuariosStandard();
      }
      , 'get');
    Route::methodNotAllowed(
      function () {
        $controller = new \Com\FernandezFran\Controllers\ErroresController();
        $controller->error405();
      }
    );
    Route::run();
  }
}

