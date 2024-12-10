<?php
declare(strict_types=1);

namespace Com\FernandezFran\Controllers;

use Com\FernandezFran\Models\CategoriaModel;
use Com\FernandezFran\Models\MarcaModel;


class ProductoController extends \Com\FernandezFran\Core\BaseController
{


  public function mostrarTodosLista()
  {
    $data = [];
    $data['seccion'] = '/productos/lista';

    $modelo = new \Com\FernandezFran\Models\ProductoModel();
    $marcas = new \Com\FernandezFran\Models\MarcaModel();
    $categorias = new \Com\FernandezFran\Models\CategoriaModel();

    $data['marcas'] = $marcas->getAll();
    $data['categorias'] = $categorias->getAll();

    // Procesar los filtros recibidos por GET
    $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);

    $data['productos'] = $modelo->getProdcutosFiltrados([
      'id_categoria' => $data['input']['categoria'] ?? null,
      'id_marca' => $data['input']['marca'] ?? null,
      'nombre' => $data['input']['nombre'] ?? null,
      'orden_stock' => $data['input']['orden_stock'] ?? null,
    ]);

    // Renderizar la vista con los datos
    $this->view->showViews(
      ['templates/header.view.php',
        'catalogo.view.php',
        'templates/footer.view.php'],
      $data
    );
  }




  //MOSTRAR TODOS OS PRODUCTOS pero para a vista de ADMIN
  public function mostrarTodos()
  {
    $data = [];
    $data['seccion'] = '/productos/lista';

    $modelo = new \Com\FernandezFran\Models\ProductoModel();
    $marcas = new \Com\FernandezFran\Models\MarcaModel();
    $categorias = new \Com\FernandezFran\Models\CategoriaModel();

    $data['marcas'] = $marcas->getAll();
    $data['categorias'] = $categorias->getAll();

    // Procesar los filtros recibidos por GET
    $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);

    $data['productos'] = $modelo->getProdcutosFiltrados([
      'id_categoria' => $data['input']['categoria'] ?? null,
      'id_marca' => $data['input']['marca'] ?? null,
      'nombre' => $data['input']['nombre'] ?? null,
      'orden_stock' => $data['input']['orden_stock'] ?? null,
    ]);

    // Renderizar la vista con los datos
    $this->view->showViews(
      ['templates/header.view.php',
        'catalogocards.view.php',
        'templates/footer.view.php'],
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


      // Validación
      $errors = [];
      if (!$nombre || !$descripcion || !$precio || !$stock || !$id_categoria || !$id_marca || !$imagen) {
        $errors[]='Todos los campos son obligatorios.';
      }

      if ( !is_numeric($precio) || $precio <= 0) {
        $errors[] = "El precio debe ser un número positivo.";
      }
      if ( !is_numeric($stock) || $stock < 0) {
        $errors[] = "El stock debe ser un número entero positivo.";
      }
      if (!is_numeric($id_categoria)) {
        $errors[] = "La categoría no es válida.";
      }
      if ( !is_numeric($id_marca)) {
        $errors[] = "La marca no es válida.";
      } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
          $errors[] = "La imagen debe ser un archivo de tipo JPG, JPEG o PNG .";
        }
        if ($_FILES['imagen']['size'] > 10 * 1024 * 1024) {
          $errors[] = "La imagen no puede pesar más de 10 Mb.";
        }
      }

      if (count($errors) > 0) {
        foreach ($errors as $error) {
          echo "<p class='error'>$error</p>";
        }
      } else {

        // Generar un nombre único para la imagen
        $numeroAleatorio = uniqid(); // Genera un identificador único
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower($nombre));
        $extension = pathinfo($imagen, PATHINFO_EXTENSION);
        $nombreImagenFinal = $numeroAleatorio . '_' . $nombreLimpio . '.' . $extension;

        // Ruta para guardar la imagen
        $target_dir = 'assets/img/gorras/';
        $target_file = $target_dir . $nombreImagenFinal;

        // Subir la imagen al servidor
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
          // Si la imagen se sube correctamente, insertar el producto en la base de datos
          $productoModel = new \Com\FernandezFran\Models\ProductoModel();
          $productoModel->agregarProducto($nombre, $descripcion, $precio, $stock, $id_categoria, $id_marca, $nombreImagenFinal);
        }
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


      //var_dump($_POST);

      // Validaciones
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
      $stock = filter_input( INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT);
      if ($stock < 0) {
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

      if (isset($_FILES['imagen']) && $_FILES['imagen']['tmp_name']) {
        // Validación de extensión
        $extensionesPermitidas = ['jpg', 'jpeg', 'png'];
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($extension), $extensionesPermitidas)) {
          die('El formato de imagen no es: jpg, jpeg, png.');
        }

        // Generar un nombre temporal único
        $nombreTemporal = uniqid('temp_', true) . '.' . $extension;
        $target_dir = 'assets/img/gorras/';
        $target_temp_file = $target_dir . $nombreTemporal;

        // Subir la nueva imagen temporalmente
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_temp_file)) {
          // Eliminar la imagen anterior
          if (!empty($producto['imagen'])) {
            $imagenAnterior = $target_dir . $producto['imagen'];
            if (file_exists($imagenAnterior)) {
              unlink($imagenAnterior);
            }
          }

          $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower($nombre));
          $nombreImagenFinal = $id . '_' . $nombreLimpio . '.' . $extension;
          $target_final_file = $target_dir . $nombreImagenFinal;

          if (rename($target_temp_file, $target_final_file)) {
            $nombreImagen = $nombreImagenFinal;
          } else {
            die('Error al renombrar la nueva imagen.');
          }
        } else {
          die('Error al subir la nueva imagen.');
        }
      } else {
        // Mantén la imagen anterior si hay un error
        $nombreImagen = $producto['imagen'];
      }

      if (!$id || !$nombre || !$descripcion || !$precio || !$id_categoria || !$id_marca ) {
        $_SESSION['error'] = 'Todos los campos son obligatorios.';
        header('Location: /productos/editar/'.$id);
        exit;
      }

      $productoModel = new \Com\FernandezFran\Models\ProductoModel();
      $productoModel->actualizarProducto($id, $nombre, $descripcion, $precio, $stock, $id_categoria, $id_marca, $nombreImagen);
      header('Location: /productos/lista');
      $_SESSION['success'] = 'Producto actualizado correctamente.';
    }
    $this->view->showViews(
      [
        'templates/header.view.php',
        'editarproducto.view.php',
        'templates/footer.view.php'
      ], $data
    );
  }



  public function verProducto($id)
  {
    $productoModel = new \Com\FernandezFran\Models\ProductoModel();
    $producto = $productoModel->obtenerProductoPorId($id);

    if (!$producto) {
      header('Location: /productos');
      exit;
    }
    $data = [];
    $data['titulo'] = $producto['nombre'];
    $data['producto'] = $producto;

    $this->view->showViews(
      [
        'templates/header.view.php',
        'producto.view.php',
        'templates/footer.view.php'
      ],
      $data
    );
  }


//Vista del carrito con el resumen de items
  public function verCarrito($retornarJSON = false)
  {
    $carrito = $_SESSION['carrito'] ?? [];

    if ($retornarJSON) {
      echo json_encode(['items' => $carrito]);
      exit;
    }

    $data = [
      'titulo' => 'Carrito',
      'carrito' => $carrito
    ];

    $this->view->showViews(
      [
        'templates/header.view.php',
        'carrito.view.php',
        'templates/footer.view.php'
      ],
      $data
    );
  }


//Actualizar carrito para cambiar cantidad de productos
  public function actualizarCarrito()
  {
    $id_producto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);

    if ($id_producto && $cantidad && $cantidad > 0) {
      foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] == $id_producto) {
          $item['cantidad'] = $cantidad;
          break;
        }
      }
    }
    header('Location: /carrito');
    exit;
  }

  //Eliminar productos del carrito
  public function eliminarDelCarrito()
  {
    $id_producto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);

    if ($id_producto && isset($_SESSION['carrito'])) {
      $_SESSION['carrito'] = array_filter($_SESSION['carrito'], function ($item) use ($id_producto) {
        return $item['id'] != $id_producto;
      });
    }
    header('Location: /carrito');
    exit;
  }



//funcion para agregar productos al carrito / recoger los productos del ajax y validarlos
//Revisar el fallo de que no se actualiza solo en el nav

  public function agregarAlCarritoAjax()
  {
    $data = json_decode(file_get_contents('php://input'), true);

    $idProducto = filter_var($data['id_producto'], FILTER_VALIDATE_INT);
    $cantidad = filter_var($data['cantidad'], FILTER_VALIDATE_INT);
    var_dump($cantidad);
    if (!$idProducto || !$cantidad || $cantidad <= 0) {
      echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
      exit;
    }

    $productoModel = new \Com\FernandezFran\Models\ProductoModel();
    $producto = $productoModel->obtenerProductoPorId($idProducto);

    if (!$producto) {
      echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
      exit;
    }

    if (!isset($_SESSION['carrito'])) {
      $_SESSION['carrito'] = [];
    }

    $carrito = &$_SESSION['carrito'];
    $index = array_search($idProducto, array_column($carrito, 'id'));

    if ($index !== false) {
      $carrito[$index]['cantidad'] += $cantidad;
    } else {
      $carrito[] = [
        'id' => $idProducto,
        'nombre' => $producto['nombre'],
        'precio' => $producto['precio'],
        'cantidad' => $cantidad,
        'imagen' => $producto['imagen']
      ];
    }

    echo json_encode(['success' => true, 'message' => 'Producto agregado correctamente.']);
    exit;
  }



}
