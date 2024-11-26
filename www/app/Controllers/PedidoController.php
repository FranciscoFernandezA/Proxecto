<?php
declare(strict_types=1);

namespace Com\FernandezFran\Controllers;

class PedidoController extends \Com\FernandezFran\Core\BaseController
{

  public function mostrarTodos()
  {
    $data = [];
    $data['titulo'] = 'Todos los pedidos';
    $data['seccion'] = '/pedidos';

    $modelo = new \Com\FernandezFran\Models\PedidoModelModel();

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

  }
