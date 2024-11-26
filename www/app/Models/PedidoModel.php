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

}
