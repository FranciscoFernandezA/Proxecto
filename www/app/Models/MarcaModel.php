<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

class MarcaModel extends \Com\FernandezFran\Core\BaseModel
{
  private const SELECT_ALL_MARCAS = 'SELECT * FROM marcas';

  public function getAll(): array
  {
    $stmt = $this->pdo->query(self::SELECT_ALL_MARCAS);
    return $stmt->fetchAll();
  }
}
