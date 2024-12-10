<?php

namespace Com\FernandezFran\Core;

use Steampixel\Route;

class FrontController
{


  static function main()
  {
    if (!isset($_SESSION['nombre'])) {
      session_start();
    }
    if (!isset($_SESSION['carrito'])) {
      $_SESSION['carrito'] = [];
    }




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
    //----------- SESIÓN ------------//

    if (!isset($_SESSION['nombre'])) {
      Route::add('/logout', function () {
        header("Location: /");
        exit;
      }, 'get');

      Route::add('/login', function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->mostrarLogin();
      }, 'get');

      Route::add('/login', function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->mostrarLogin();
      }, 'post');


      Route::add('/registro', function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->mostrarRegistro();
      }, 'get');

      Route::add('/registro', function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->mostrarRegistro();
      }, 'post');

    } else {
      Route::add('/login', function () {
        header("Location: /");
        exit;
      }, 'get');

      Route::add('/registro', function () {
        header("Location: /");
        exit;
      }, 'get');


      Route::add('/logout', function () {
        header("Location: /");
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
        $controlador->cerrarSesion();
      }, 'get');

    }
    //----------- CARRITO ------------//


    Route::add('/carrito/agregar', function() {
      $controlador = new \Com\FernandezFran\Controllers\ProductoController();
      $controlador->agregarAlCarritoAjax();
    }, 'post');


    Route::add('/carrito', function() {
      $controlador = new \Com\FernandezFran\Controllers\ProductoController();
      $controlador->verCarrito();
    }, 'get');

    Route::add('/carrito/actualizar', function() {
      $controlador = new \Com\FernandezFran\Controllers\ProductoController();
      $controlador->actualizarCarrito();
    }, 'post');

    Route::add('/carrito/eliminar', function() {
      $controlador = new \Com\FernandezFran\Controllers\ProductoController();
      $controlador->eliminarDelCarrito();
    }, 'post');


    Route::add('/carrito/contenido', function() {
      $controlador = new \Com\FernandezFran\Controllers\ProductoController();
      $controlador->   obtenerCarrito(true);
    }, 'post');



    //----------- PRODUCTOS ------------//




    Route::add('/productos/editar/([0-9]+)', function ($id) {
      $controlador = new \Com\FernandezFran\Controllers\ProductoController();
      $controlador->editar($id);
    }, 'get');

    Route::add('/productos/editar/([0-9]+)', function ($id) {
      $controlador = new \Com\FernandezFran\Controllers\ProductoController();
      $controlador->editar($id);
    }, 'post');


    Route::add('/producto/([0-9]+)', function($id) {
      $controlador = new \Com\FernandezFran\Controllers\ProductoController();
      $controlador->verProducto($id);
    }, 'get');


    Route::add('/productos/nuevo',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\ProductoController();
        $controlador->mostrarAgregarProducto();
      },
      'get'
    );
    Route::add('/productos/nuevo',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\ProductoController();
        $controlador->mostrarAgregarProducto();
      },
      'post'
    );
    Route::add('/productos',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\ProductoController();
        $controlador->mostrarTodos();
      }
      , 'get');

    Route::add('/productos/lista',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\ProductoController();
        $controlador->mostrarTodosLista();
      }
      , 'get');

    Route::add('/productos/ver/([0-9]+)', function ($id) {
      $controlador = new \App\Controllers\ProductoController();
      $controlador->verProducto($id);
    }, 'get');



    //-----------  PEDIDOS  ------------//


    Route::add('/pedidos',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\PedidoController();
        $controlador->mostrarTodos();
      }
      , 'get');

    Route::add('/pedido/crear', function () {
      $controlador = new \Com\FernandezFran\Controllers\PedidoController();
      $controlador->crearPedido();
    }, 'post');


    Route::add('/pedido/confirmar', function() {
      $controlador = new \Com\FernandezFran\Controllers\PedidoController();
      $controlador->confirmarPedido();
    }, 'get');

    Route::add('/pedido/confirmar', function() {
      $controlador = new \Com\FernandezFran\Controllers\PedidoController();
      $controlador->confirmarPedido();
    }, 'post');

    Route::add('/pedido/completado', function () {
      $controlador = new \Com\FernandezFran\Controllers\PedidoController();
      $controlador->pedidoCompletado();
    }, 'get');

    Route::add('/pedidos/editar/([0-9]+)', function ($id) {
      $controlador = new \Com\FernandezFran\Controllers\PedidoController();
      $controlador->editarEstado($id);
    }, 'get');

    Route::add('/pedidos/editar/([0-9]+)', function ($id) {
      $controlador = new \Com\FernandezFran\Controllers\PedidoController();
      $controlador->editarEstado($id);
    }, 'post');


    Route::add('/mispedidos', function () {
      $controlador = new \Com\FernandezFran\Controllers\PedidoController();
      $controlador->misPedidos();
    }, 'get');



    //-------------- USUARIOS -------------//

    Route::add('/usuarios',
      function () {
        $controlador = new \Com\FernandezFran\Controllers\UsuarioController();
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

