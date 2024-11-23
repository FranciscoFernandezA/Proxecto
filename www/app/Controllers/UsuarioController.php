<?php
declare(strict_types=1);

namespace Com\FernandezFran\Controllers;

class UsuarioController extends \Com\FernandezFran\Core\BaseController
{

  public function mostrarTodos()
  {
    $data = [];
    $data['titulo'] = 'Todos los usuarios';
    $data['seccion'] = '/usuarios';

    $modelo = new \Com\FernandezFran\Models\UsuarioModel();

    // Procesar los filtros recibidos por GET
    $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($_GET['tipo_usuario']) && in_array($_GET['tipo_usuario'], ['admin', 'cliente'], true)) {
      // Filtrar por tipo
      $data['usuarios'] = $modelo->filterByTipo($_GET['tipo_usuario']);
    } elseif (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
      // Filtrar por nombre
      $data['usuarios'] = $modelo->filterByName($_GET['nombre']);
    } elseif (isset($_GET['telefono']) && !empty($_GET['telefono'])) {
      // Filtrar por número de teléfono
      $data['usuarios'] = $modelo->filterByTelefono($_GET['telefono']);
    } else {
      $data['usuarios'] = $modelo->getAll();
    }


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

    $modelo = new \Com\FernandezFran\Models\UsuarioModel();

    $data['usuarios'] = $modelo->getAllOrdenadosPorFecha();


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

    $modelo = new \Com\FernandezFran\Models\UsuarioModel();

    $data['usuarios'] = $modelo->getClientes();

    $this->view->showViews(
      ['templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'],
      $data
    );
  }
}
