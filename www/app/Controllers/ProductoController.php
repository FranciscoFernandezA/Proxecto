<?php
declare(strict_types=1);

namespace Com\FernandezFran\Controllers;

class ProductoController extends \Com\FernandezFran\Core\BaseController
{
  public function mostrarTodos()
  {
    $data = [];
    $data['titulo'] = 'Catálogo de Productos';
    $data['seccion'] = '/productos';

    $modelo = new \Com\FernandezFran\Models\ProductoModel();

    // Procesar los filtros recibidos por GET
    $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);

    // Filtrar por id_categoría
    if (isset($_GET['id_categoria']) && !empty($_GET['id_categoria'])) {
      $data['productos'] = $modelo->filterByCategoria($_GET['id_categoria']);
    }// Filtrar por nombre
    elseif (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
      $data['productos'] = $modelo->filterByName($_GET['nombre']);
    } //todos los productos
    else {
      $data['productos'] = $modelo->getAll();
    }

    // Renderizar las vistas con los datos
    $this->view->showViews(
      ['templates/header.view.php', 'catalogocards.view.php', 'templates/footer.view.php'],
      $data
    );
  }


  public function mostrarTodoslista()
  {

    $data = [];
    $data['titulo'] = 'Catálogo de Productos';
    $data['seccion'] = '/productos';


    $modelo = new \Com\FernandezFran\Models\ProductoModel();


    // Procesar los filtros recibidos por GET
    $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);

    // Filtrar por id_categoría
    if (isset($_GET['id_categoria']) && !empty($_GET['id_categoria'])) {
      $data['productos'] = $modelo->filterByCategoria($_GET['id_categoria']);
    }// Filtrar por nombre
    elseif (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
      $data['productos'] = $modelo->filterByName($_GET['nombre']);
    } //todos los productos
    else {
      $data['productos'] = $modelo->getAll();
    }

    // Renderizar las vistas con los datos
    $this->view->showViews(
      ['templates/header.view.php', 'catalogo.view.php', 'templates/footer.view.php'],
      $data
    );
  }
}
