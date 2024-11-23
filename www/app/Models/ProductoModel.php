<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

class UsuarioModel extends \Com\FernandezFran\Core\BaseModel
{
  private const SELECT_FROM = 'SELECT * FROM productos';

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

}
