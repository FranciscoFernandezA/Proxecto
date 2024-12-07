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



  public function editar($id)
  {


    if (!$id) {
      header('Location: /productos');
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Validaciones para el formulario de actualización
      $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
      $nombre = trim($_POST['nombre']);
      if (empty($nombre) || strlen($nombre) > 150) {
        die('Nombre inválido');
      }
      $descripcion = trim($_POST['descripcion']);
      if (strlen($descripcion) > 500) {
        die('Descripción inválida');
      }
      $precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
      if ($precio === false || $precio <= 0) {
        die('Precio inválido');
      }
      $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
      if ($stock === false || $stock < 0) {
        die('Stock inválido');
      }
      $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);
      if (!$id_categoria || $id_categoria <= 0) {
        die('Categoría  inválida.');
      }
      $id_marca = filter_input(INPUT_POST, 'id_marca', FILTER_VALIDATE_INT);
      if (!$id_marca || $id_marca <= 0) {
        die('Marca  inválida.');
      }

      if (!$id || !$nombre || !$descripcion || !$precio || !$stock || !$id_categoria || !$id_marca) {
        $_SESSION['error'] = 'Todos los campos son obligatorios.';
        header('Location: /productos/editar?id=' . $id);
        exit;
      }
      // Lógica de actualización
      $productoModel = new \Com\FernandezFran\Models\ProductoModel();
      $productoModel->actualizarProducto($id, $nombre, $descripcion, $precio, $stock, $id_categoria, $id_marca);

      $_SESSION['success'] = 'Producto actualizado correctamente.';
      header('Location: /productos/editar?id=' . $id);
      exit;
    }

    $data = [];
    $data['titulo'] = 'Editar producto';
    $data['seccion'] = '/productos/editar';

    $productoModel = new \Com\FernandezFran\Models\ProductoModel();
    $producto = $productoModel->obtenerProductoPorId($id);

    if (!$producto) {
      header('Location: /productos');
      exit;
    }

    $marcaModel = new \Com\FernandezFran\Models\MarcaModel();
    $categoriaModel = new \Com\FernandezFran\Models\CategoriaModel();
    $marcas = $marcaModel->getAll();
    $categorias = $categoriaModel->getAll();

    $data['producto'] = $producto;
    $data['marcas'] = $marcas;
    $data['categorias'] = $categorias;

    $this->view->showViews(
      [
        'templates/header.view.php',
        'editarproducto.view.php',
        'templates/footer.view.php'
      ], $data
    );
  }





}
