<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

use PDO;

class ProductoModel extends \Com\FernandezFran\Core\BaseModel
{

  private const SELECT_FROM = '
    SELECT p.*,
           c.nombre AS nombre_categoria,
           m.nombre AS nombre_marca
    FROM productos p
    LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
    LEFT JOIN marcas m ON p.id_marca = m.id_marca
';

  public function getAll(): array
  {
    $stmt = $this->pdo->query(self::SELECT_FROM);
    return $stmt->fetchAll();
  }


  public function getProdcutosFiltrados(array $filtros): array
  {
    $query = self::SELECT_FROM; // Base de la consulta
    $params = [];
    $conditions = [];

    // Filtro por categoría
    if (!empty($filtros['id_categoria'])) {
      $conditions[] = 'p.id_categoria = ?';
      $params[] = $filtros['id_categoria'];
    }

    // Filtro por marca
    if (!empty($filtros['id_marca'])) {
      $conditions[] = 'p.id_marca = ?';
      $params[] = $filtros['id_marca'];
    }

    // Filtro por nombre
    if (!empty($filtros['nombre'])) {
      $conditions[] = 'p.nombre LIKE ?';
      $params[] = '%' . $filtros['nombre'] . '%';
    }

    // Crear condiciones
    if (!empty($conditions)) {
      $query .= ' WHERE ' . implode(' AND ', $conditions);
    }

    // Ordenar por stock
    if (!empty($filtros['orden_stock']) && in_array(strtolower($filtros['orden_stock']), ['asc', 'desc'], true)) {
      $query .= ' ORDER BY p.stock ' . strtoupper($filtros['orden_stock']);
    }

    $stmt = $this->pdo->prepare($query);
    $stmt->execute($params);

    return $stmt->fetchAll();
  }


  // Agregar un nuevo producto
  public function agregarProducto($nombre, $descripcion, $precio, $stock, $id_categoria, $id_marca, $imagen) {

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


  public function actualizarProducto($id, $nombre, $descripcion, $precio, $stock, $id_categoria, $id_marca, $imagen)
  {

    try {
    $query = "
        UPDATE productos
        SET
            nombre = :nombre,
            descripcion = :descripcion,
            precio = :precio,
            stock = :stock,
            id_categoria = :id_categoria,
            id_marca = :id_marca,
            imagen = :imagen
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
      'imagen' => $imagen,
    ]);
    } catch (PDOException $e) {
      // Registro de error en la base de datos
      error_log("Error al actualizar el producto: " . $e->getMessage());
      return false;
    }

    return true;
  }


  //Actualización de stock cuando creamos el pedido
  public function reducirStock(int $id_producto, int $cantidad): bool
  {
    $stmt = $this->pdo->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ? AND stock >= ?");
    return $stmt->execute([$cantidad, $id_producto, $cantidad]);
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
