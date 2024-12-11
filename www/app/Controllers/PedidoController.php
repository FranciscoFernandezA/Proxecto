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

    // Filtrar por estado
    if (isset($_GET['estado']) && in_array($_GET['estado'], ['pagado', 'pendiente', 'enviado', 'entregado', 'cancelado'], true)) {
      $data['pedidos'] = $modelo->filterByEstado($_GET['estado']);
    }
    // Ordenar por fecha
    else if (isset($_GET['orden']) && in_array($_GET['orden'], ['recientes', 'antiguos'], true)) {
      $data['pedidos'] = $modelo->orderByFecha($_GET['orden']);
    } else {
      $data['pedidos'] = $modelo->getAll();
    }

    if (!$data['pedidos']) {
      $data['error'] = 'No se encontraron registros que cumplan los filtros aplicados.';
    }

    $this->view->showViews(
      ['templates/header.view.php',
        'pedidos.view.php',
        'templates/footer.view.php'],
      $data
    );
  }



  public function confirmarPedido()
  {
    if (empty($_SESSION['carrito'])) {
      $_SESSION['error'] = 'El carrito está vacío.';
      header('Location: /carrito');
      exit;
    }

    $pedidoModel = new \Com\FernandezFran\Models\PedidoModel();
    $metodosPago = $pedidoModel->obtenerMetodosPago(); // Obtener los métodos de pago.

    $total = array_reduce($_SESSION['carrito'], function ($acum, $item) {
      return $acum + ($item['precio'] * $item['cantidad']);
    }, 0);

    unset($_SESSION['success']);
    unset($_SESSION['error']);

    $data = [
      'carrito' => $_SESSION['carrito'],
      'total' => $total,
      'metodosPago' => $metodosPago,
    ];

    $this->view->showViews(
      [
        'templates/header.view.php',
        'confirmarpedido.view.php',
        'templates/footer.view.php',
      ],
      $data
    );
  }


  public function crearPedido()
  {
    $id_usuario = $_SESSION['usuario_id'] ?? null;

    $id_metodo_pago = filter_input(INPUT_POST, 'id_metodo_pago', FILTER_VALIDATE_INT);

    if (!$id_usuario || !$id_metodo_pago) {
      $_SESSION['error'] = 'Debe seleccionar un método de pago.';
      header('Location: /pedido/confirmar');
      exit;
    }

    if (empty($_SESSION['carrito'])) {
      $_SESSION['error'] = 'El carrito está vacío.';
      header('Location: /pedido/confirmar');
      exit;
    }

    // Calculo del total, uso array_reduce para simplificar el cálculo
    // reduce un array a un solo valor aplicando una función
    $total = array_reduce($_SESSION['carrito'], function ($acum, $item) {
      return $acum + ($item['precio'] * $item['cantidad']);
    }, 0);

    if ($total <= 0) {
      $_SESSION['error'] = 'El total del pedido no puede ser cero.';
      header('Location: /pedido/confirmar');
      exit;
    }

    //Creación del pedido
    $pedidoModel = new \Com\FernandezFran\Models\PedidoModel();
    $id_pedido = $pedidoModel->crearPedido($id_usuario, $total, $id_metodo_pago);

    if (!$id_pedido) {
      $_SESSION['error'] = 'Error al crear el pedido.';
      header('Location: /pedido/confirmar');
      exit;
    }

    // Detalles del pedido
    foreach ($_SESSION['carrito'] as $item) {

      //Convierto los valores para evitar problemas en el modelo
      $id_producto = (int) $item['id'];
      $cantidad = (int) $item['cantidad'];
      $precio_unitario = (float) $item['precio'];

      if (!$pedidoModel->agregarDetallePedido($id_pedido, $id_producto, $cantidad, $precio_unitario)) {
        error_log('Error: No se pudo agregar un detalle del pedido' . $item['id']);
      }

      $productoModel = new \Com\FernandezFran\Models\ProductoModel();

      // Actualizar el stock del producto
      if (!$productoModel->reducirStock($id_producto, $cantidad)) {
        error_log('Error: No se pudo reducir el stock del producto: ' . $id_producto);
      }
    }

    unset($_SESSION['carrito']);
    header('Location: /pedido/completado');
    exit;
  }



  public function pedidoCompletado()
  {
    $data = [];
    $data['titulo'] = 'Pedido Completado';
    $data['mensaje'] = 'Tu pedido se ha completado. Gracias por tu compra.';

    $this->view->showViews(
      [
        'templates/header.view.php',
        'pedidoCompletado.view.php',
        'templates/footer.view.php'
      ],
      $data
    );

}




  public function misPedidos()
  {
    $data=[];

    $id_usuario = $_SESSION['usuario_id'];

    if (!$id_usuario) {
      $_SESSION['error'] = 'Usuario no autenticado.';
      header('Location: /login');
      exit;
    }

    $pedidoModel = new \Com\FernandezFran\Models\PedidoModel();
    $pedidos = $pedidoModel->obtenerPedidosPorUsuario($id_usuario);

    if ($pedidos === false) {
      $_SESSION['error'] = 'No se pudieron obtener los pedidos.';
      header('Location: /');
      exit;
    }
    $data['nombre'] = $_SESSION['nombre'];
    $data['apellidos'] = $_SESSION['apellidos'];
    $data['pedidos'] = $pedidos;


    $this->view->showViews(
      [
        'templates/header.view.php',
        'mispedidos.view.php',
        'templates/footer.view.php'
      ],
      $data
    );
  }


  public function editarEstado($id_pedido)
  {
    if (!$id_pedido) {
      header('Location: /pedidos');
      exit;
    }

    $pedidoModel = new \Com\FernandezFran\Models\PedidoModel();
    $pedido = $pedidoModel->obtenerPedidoPorId($id_pedido);

    if (!$pedido) {
      header('Location: /pedidos');
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nuevoEstado = $_POST['estado'];

      $estadosValidos = ['pagado', 'pendiente', 'enviado', 'entregado', 'cancelado'];
      if (!in_array($nuevoEstado, $estadosValidos)) {
        die('Estado inválido.');
      }

      $pedidoModel->actualizarEstado($id_pedido, $nuevoEstado);

      $_SESSION['success'] = 'Estado del pedido actualizado correctamente.';
      header('Location: /pedidos');
      exit;
    }

    $data = [
      'pedido' => $pedido,
      'estadosValidos' => ['pagado', 'pendiente', 'enviado', 'entregado', 'cancelado']
    ];

    $this->view->showViews(
      [
        'templates/header.view.php',
        'editarpedido.view.php',
        'templates/footer.view.php'
      ],
      $data
    );
  }




}
