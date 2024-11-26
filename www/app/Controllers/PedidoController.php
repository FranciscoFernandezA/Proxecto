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

    $modelo = new \Com\FernandezFran\Models\PedidoModel();

    // Procesar los filtros recibidos por GET
    $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($_GET['estado']) && in_array($_GET['estado'], ['pagado', 'pendiente', 'enviado', 'entregado', 'cancelado'], true)) {
      // Filtrar por tipo
      $data['pedidos'] = $modelo->filterByEstado($_GET['estado']);
    }else {
        $data['pedidos'] = $modelo->getAll();
      }

      // Renderizar las vistas con los datos
      $this->view->showViews(
        ['templates/header.view.php', 'pedidos.view.php', 'templates/footer.view.php'],
        $data
      );
    }


  }
