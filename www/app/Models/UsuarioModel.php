<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

class UsuarioModel extends \Com\FernandezFran\Core\BaseModel
{
  private const SELECT_FROM = 'SELECT * FROM usuarios';

  public function getAll(): array
  {
    $stmt = $this->pdo->query(self::SELECT_FROM);
    return $stmt->fetchAll();
  }

  public function filterByTipo(string $tipo): array
  {
    $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE tipo_usuario = ?');
    $stmt->execute([$tipo]);
    return $stmt->fetchAll();
  }

  public function filterByName(string $nombre): array
  {
    $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE nombre LIKE ?');
    $stmt->execute(['%' . $nombre . '%']);
    return $stmt->fetchAll();
  }

  public function filterByTelefono(string $telefono): array
  {
    $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE telefono LIKE ?');
    $stmt->execute(['%' . $telefono . '%']);
    return $stmt->fetchAll();
  }

  public function getAllOrdenadosPorFecha(): array
  {
    $stmt = $this->pdo->query(self::SELECT_FROM . ' ORDER BY fecha_registro DESC');
    return $stmt->fetchAll();
  }

  public function getClientes(): array
  {
    $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE tipo_usuario = ?');
    $stmt->execute(['cliente']);
    return $stmt->fetchAll();
  }
}
