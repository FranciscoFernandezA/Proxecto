<?php
declare(strict_types=1);

namespace Com\FernandezFran\Controllers;

class UsuarioController extends \Com\FernandezFran\Core\BaseController
{
  // Mostrar todos los usuarios con filtros opcionales
  public function mostrarTodos()
  {
    $data = [];
    $data['titulo'] = 'Todos los usuarios';
    $data['seccion'] = '/usuarios';

    // Instancia del modelo de Usuario
    $modelo = new \Com\FernandezFran\Models\UsuarioModel();

    // Procesar los filtros recibidos por GET
    $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($_GET['tipo_usuario']) && in_array($_GET['tipo_usuario'], ['admin', 'cliente'], true)) {
      // Filtrar usuarios por tipo
      $data['usuarios'] = $modelo->filterByTipo($_GET['tipo_usuario']);
    } elseif (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
      // Filtrar usuarios por nombre
      $data['usuarios'] = $modelo->filterByName($_GET['nombre']);
    } elseif (isset($_GET['telefono']) && !empty($_GET['telefono'])) {
      // Filtrar usuarios por número de teléfono
      $data['usuarios'] = $modelo->filterByTelefono($_GET['telefono']);
    } else {
      // Sin filtros: obtener todos los usuarios
      $data['usuarios'] = $modelo->getAll();
    }

    // Renderizar las vistas con los datos
    $this->view->showViews(
      ['templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'],
      $data
    );
  }

  // Mostrar todos los usuarios ordenados por fecha de registro
  public function mostrarTodosOrdenados()
  {
    $data = [];
    $data['titulo'] = 'Usuarios ordenados por fecha de registro';
    $data['seccion'] = '/usuarios/ordered';

    // Instancia del modelo de Usuario
    $modelo = new \Com\FernandezFran\Models\UsuarioModel();

    // Obtener usuarios ordenados
    $data['usuarios'] = $modelo->getAllOrdenadosPorFecha();

    // Renderizar las vistas con los datos
    $this->view->showViews(
      ['templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'],
      $data
    );
  }

  // Mostrar usuarios de tipo "cliente"
  public function mostrarUsuariosClientes()
  {
    $data = [];
    $data['titulo'] = 'Usuarios clientes';
    $data['seccion'] = '/usuarios/clientes';

    // Instancia del modelo de Usuario
    $modelo = new \Com\FernandezFran\Models\UsuarioModel();

    // Obtener usuarios de tipo cliente
    $data['usuarios'] = $modelo->getClientes();

    // Renderizar las vistas con los datos
    $this->view->showViews(
      ['templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'],
      $data
    );
  }
}
