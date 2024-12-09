<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

class PedidoModel extends \Com\FernandezFran\Core\BaseModel
{
  private const SELECT_FROM = 'SELECT * FROM pedidos';

  public function getAll(): array
  {
    $stmt = $this->pdo->query(self::SELECT_FROM);
    return $stmt->fetchAll();
  }




  //Filtrar por estado del pedido
  public function filterByEstado(string $estado): array
  {
    $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE estado = ?');
    $stmt->execute([$estado]);
    return $stmt->fetchAll();
  }



  public function obtenerMetodosPago(): array
  {
    $stmt = $this->pdo->prepare('SELECT id_metodo_pago,nombre FROM metodos_pago');
    $stmt->execute();
    return $stmt->fetchAll();
  }



  public function crearPedido(int $id_usuario, float $total, int $id_metodo_pago): int
  {
    $estado = 'pagado';

    $sql = 'INSERT INTO pedidos (id_usuario, estado, total, id_metodo_pago) VALUES (?, ?, ?, ?)';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id_usuario, $estado, $total, $id_metodo_pago]);

    //lastInsertId => función de PDO que devuelve el último int autoincrementado que se añadió
    return (int) $this->pdo->lastInsertId();
  }



  public function agregarDetallePedido(int $id_pedido, int $id_producto, int $cantidad, float $precio_unitario): void
  {
    $sql = 'INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id_pedido, $id_producto, $cantidad, $precio_unitario]);
  }


}
