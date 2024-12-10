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
