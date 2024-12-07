<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

use PDO;

class ProductoModel extends \Com\FernandezFran\Core\BaseModel
{
  private const SELECT_FROM = '    SELECT
        productos.*,
        categorias.nombre AS nombre_categoria,
        marcas.nombre AS nombre_marca
    FROM productos
    LEFT JOIN categorias ON productos.id_categoria = categorias.id_categoria
    LEFT JOIN marcas ON productos.id_marca = marcas.id_marca';

  public function getAll(): array
  {
    $stmt = $this->pdo->query(self::SELECT_FROM);
    return $stmt->fetchAll();
  }
  public function filterByCategoria(int $categoria): array
  {
    $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE id_categoria = ?');
    $stmt->execute([$categoria]);
    return $stmt->fetchAll();
  }
  public function filterByName(string $nombre): array
  {
    $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE nombre LIKE ?');
    $stmt->execute(['%' . $nombre . '%']);
    return $stmt->fetchAll();
  }




  // Agregar un nuevo producto
  public function agregarProducto($nombre, $descripcion, $precio, $stock, $id_categoria, $id_marca, $imagen) {

      // Recibir datos del formulario
      $nombre = trim($_POST['nombre']);
      $descripcion = trim($_POST['descripcion']);
      $precio = $_POST['precio'];
      $stock = $_POST['stock'];
      $id_categoria = $_POST['id_categoria'];
      $id_marca = $_POST['id_marca'];
      $imagen = $_FILES['imagen']['name'];


      // Validación
      $errors = [];
      if (empty($nombre)) {
        $errors[] = "El nombre del producto es obligatorio.";
      }
      if (empty($descripcion)) {
        $errors[] = "La descripción del producto es obligatoria.";
      }
      if (empty($precio) || !is_numeric($precio) || $precio <= 0) {
        $errors[] = "El precio debe ser un número positivo.";
      }
      if (empty($stock) || !is_numeric($stock) || $stock < 0) {
        $errors[] = "El stock debe ser un número entero positivo.";
      }

      if (empty($id_categoria) || !is_numeric($id_categoria)) {
        $errors[] = "La categoría no es válida.";
      }
      if (empty($id_marca) || !is_numeric($id_marca)) {
        $errors[] = "La marca no es válida.";
      }
      if (empty($imagen)) {
        $errors[] = "La imagen es obligatoria.";
      } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
          $errors[] = "La imagen debe ser un archivo de tipo JPG, JPEG o PNG .";
        }
        if ($_FILES['imagen']['size'] > 5 * 1024 * 1024) {
          $errors[] = "La imagen no puede pesar más de 5 Mb.";
        }
      }
      if (count($errors) > 0) {
        foreach ($errors as $error) {
          echo "<p class='error'>$error</p>";
        }
      } else {
        move_uploaded_file($_FILES['imagen']['tmp_name'], 'assets/img/gorras/' . $imagen);

        $stmt = $this->pdo->prepare("
                INSERT INTO productos (nombre, descripcion, precio, stock, id_categoria, id_marca, imagen)
                VALUES (:nombre, :descripcion, :precio, :stock, :id_categoria, :id_marca, :imagen)
            ");

        $stmt->execute([
          'nombre' => $nombre,
          'descripcion' => $descripcion,
          'precio' => $precio,
          'stock' =>$stock,
          'id_categoria' => $id_categoria,
          'id_marca' => $id_marca,
          'imagen' => $imagen
        ]);
      }
  }


  public function actualizarProducto($id, $nombre, $descripcion, $precio, $stock, $id_categoria, $id_marca)
  {
    $query = "
        UPDATE productos
        SET
            nombre = :nombre,
            descripcion = :descripcion,
            precio = :precio,
            stock = :stock,
            id_categoria = :id_categoria,
            id_marca = :id_marca
        WHERE id_producto = :id_producto";

    $stmt = $this->pdo->prepare($query);
    $stmt->execute([
      'id_producto' => $id,
      'nombre' => $nombre,
      'descripcion' => $descripcion,
      'precio' => $precio,
      'stock' => $stock,
      'id_categoria' => $id_categoria,
      'id_marca' => $id_marca,
    ]);
  }




  //Producto por id
  public function obtenerProductoPorId($id)
  {
    $query = "
        SELECT
            p.*,
            c.nombre AS categoria_nombre,
            m.nombre AS marca_nombre
        FROM
            productos p
        LEFT JOIN
            categorias c ON p.id_categoria = c.id_categoria
        LEFT JOIN
            marcas m ON p.id_marca = m.id_marca
        WHERE
            p.id_producto = :id
    ";

    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }


}
