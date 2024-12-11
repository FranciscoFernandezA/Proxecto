<?php

namespace Com\FernandezFran\Controllers;

class InicioController extends \Com\FernandezFran\Core\BaseController {

    public function index() {

      $modeloProducto = new \Com\FernandezFran\Models\ProductoModel();
      $productos = $modeloProducto->getAll();

      $modeloCategoria = new \Com\FernandezFran\Models\CategoriaModel();
      $categorias = $modeloCategoria->getAll();

        $data = array(
            'productos' => $productos,
          'categorias' => $categorias,
        );
        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
    }

}
