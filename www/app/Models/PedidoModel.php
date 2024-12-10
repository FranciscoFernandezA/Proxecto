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

  public function orderByFecha(string $orden): array
  {
    try {
      $query = self::SELECT_FROM . " ORDER BY fecha_pedido " . ($orden === 'recientes' ? 'DESC' : 'ASC');
      $stmt = $this->pdo->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      // Puedes loguear el error para ayudarte a depurarlo
      error_log("Error en orderByFecha: " . $e->getMessage());
      return [];
    }
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




  // Consulta para obtener los pedidos
  public function obtenerPedidosPorUsuario($id_usuario)
  {
    try {
      $query = '
                SELECT p.id_pedido, p.fecha_pedido, p.total
                FROM pedidos p
                WHERE p.id_usuario = :id_usuario
                ORDER BY p.fecha_pedido DESC
            ';
      $stmt = $this->pdo->prepare($query);
      $stmt->execute(['id_usuario' => $id_usuario]);

      $pedidos = $stmt->fetchAll( \PDO::FETCH_ASSOC);

      foreach ($pedidos as &$pedido) {
        $pedido['detalles'] = $this->obtenerDetallesPedido($pedido['id_pedido']);
      }

      return $pedidos;
    } catch (PDOException $e) {
      error_log("Error en obtenerPedidosPorUsuario: " . $e->getMessage());
      return false;
    }
  }



  // Consulta para obtener los pedidos
  public function obtenerPedidoPorId($id_pedido)
  {
    try {
      $query = '
                SELECT p.*, u.nombre, u.apellidos
            FROM pedidos p
            JOIN usuarios u ON p.id_usuario = u.id_usuario
            WHERE p.id_pedido = :id_pedido
            ';
      $stmt = $this->pdo->prepare($query);
      $stmt->execute(['id_pedido' => $id_pedido]);

      $pedido= $stmt->fetchAll();

        $pedido['detalles'] = $this->obtenerDetallesPedido($id_pedido);


      return $pedido;
    } catch (PDOException $e) {
      error_log("Error en obtenerPedidosPorUsuario: " . $e->getMessage());
      return false;
    }
  }



  // Consulta para obtener los detalles de pedido
  private function obtenerDetallesPedido($id_pedido)
  {
    try {

      $query = '
            SELECT pd.id_producto, pd.cantidad, pd.precio_unitario, p.nombre AS nombre_producto
            FROM detalles_pedido pd
            JOIN productos p ON pd.id_producto = p.id_producto
            WHERE pd.id_pedido = :id_pedido
        ';
      $stmt = $this->pdo->prepare($query);
      $stmt->execute(['id_pedido' => $id_pedido]);

      $detalles = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $detalles;
    } catch (PDOException $e) {
      error_log("Error en obtenerDetallesPedido: " . $e->getMessage());
      return [];
    }
  }




  //Actualizar el estado del pedido
  public function actualizarEstado($id_pedido, $nuevoEstado)
  {
    $query = "UPDATE pedidos SET estado = :estado WHERE id_pedido = :id_pedido";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':estado', $nuevoEstado, \PDO::PARAM_STR);
    $stmt->bindParam(':id_pedido', $id_pedido, \PDO::PARAM_INT);
    return $stmt->execute();
  }


}
