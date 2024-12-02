<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

class CategoriaModel extends \Com\FernandezFran\Core\BaseModel
{
  private const SELECT_ALL_CATEGORIAS = 'SELECT * FROM categorias';

  public function getAll(): array
  {
    $stmt = $this->pdo->query(self::SELECT_ALL_CATEGORIAS);
    return $stmt->fetchAll();
  }
}
