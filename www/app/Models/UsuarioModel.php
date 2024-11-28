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



  //Funcion que valida e introduce el nuevo usuario
  public function registrarUsuario($nombre, $apellidos, $email, $password, $telefono, $direccion)
  {
    try {

      // Limpiar y sanitizar
      $nombre = htmlspecialchars(trim($nombre), ENT_QUOTES, 'UTF-8');
      $apellidos = htmlspecialchars(trim($apellidos), ENT_QUOTES, 'UTF-8');
      $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
      $password = trim($password);
      $telefono = filter_var(trim($telefono), FILTER_SANITIZE_NUMBER_INT);
      $direccion = htmlspecialchars(trim($direccion), ENT_QUOTES, 'UTF-8');


      // Validaciones de entrada
      if (empty($nombre) || empty($apellidos) || empty($email) || empty($password) || empty($telefono) || empty($direccion)) {
        return "Todos los campos son obligatorios.";
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "El formato del correo electrónico no es válido.";
      }
      if (strlen($password) < 8) {
        return "La contraseña debe tener al menos 8 caracteres.";
      }
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      // Comprobar si el correo ya está en uso
      $stmt = $this->pdo->prepare("SELECT email FROM usuarios WHERE email = :email");
      $stmt->execute(['email' => $email]);

      if ($stmt->fetch()) {
        return "El usuario o correo ya está registrado.";
      }

      $stmt = $this->pdo->prepare("
                INSERT INTO usuarios (nombre, apellidos, email, password, telefono, direccion)
                VALUES (:nombre, :apellidos, :email, :password, :telefono, :direccion)
            ");
      $stmt->execute([
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'email' => $email,
        'password' => $passwordHash,
        'telefono' => $telefono,
        'direccion' => $direccion
      ]);

      return "Registro exitoso.";
    } catch (\PDOException $e) {
      error_log("Error en registro de usuario: " . $e->getMessage());
      return "Error al registrar el usuario. Por favor, intenta de nuevo más tarde.".$e->getMessage();
    }
  }

}





