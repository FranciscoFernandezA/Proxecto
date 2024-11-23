<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

class ProductoModel extends \Com\FernandezFran\Core\BaseModel
{
  private const SELECT_FROM = 'SELECT * FROM productos';

  // Obtener todos los productos
  public function getAll(): array
  {
    $stmt = $this->pdo->query(self::SELECT_FROM);
    return $stmt->fetchAll();
  }
}
