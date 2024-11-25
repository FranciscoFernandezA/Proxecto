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

    Route::add('/usuario/test',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->test();
      }
      , 'get');

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

    Route::add('/usuarios/carlos',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->mostrarUsuariosCarlos();
      }
      , 'get');

    Route::add('/proveedores',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\ProveedorController();
        $controlador->mostrarTodos();
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

