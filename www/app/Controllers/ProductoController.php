<?php
declare(strict_types=1);

namespace Com\FernandezFran\Controllers;

use Com\FernandezFran\Models\CategoriaModel;
use Com\FernandezFran\Models\MarcaModel;


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

  public function mostrarAgregarProducto() {


    $data = [];
    $data['titulo'] = 'Nuevo producto';
    $data['seccion'] = '/productos/new';

    $marcaModel = new \Com\FernandezFran\Models\MarcaModel();
    $categoriaModel = new \Com\FernandezFran\Models\CategoriaModel();

    // Obtener todas las categorías
    $categorias = $categoriaModel->getAll();
    $marcas= $marcaModel->getAll();

    $data['categorias'] = $categorias;
    $data['marcas'] = $marcas;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $precio = $_POST['precio'];
      $stock = $_POST['stock'];
      $id_categoria = $_POST['id_categoria'];
      $id_marca = $_POST['id_marca'];
      $imagen = $_FILES['imagen']['name'];

      $target_dir = 'assets/img/gorras/';
      $target_file = $target_dir . basename($imagen);
      if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        $productoModel = new \Com\FernandezFran\Models\ProductoModel();
        $productoModel->agregarProducto($nombre, $descripcion, $precio, $stock, $id_categoria, $id_marca, $imagen);
      } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
      }
    }

    $this->view->showViews(
      [
        'templates/header.view.php',
        'newproducto.view.php',
        'templates/footer.view.php'
      ], $data

    );
  }


}
