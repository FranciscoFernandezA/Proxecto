
<div class="container mt-5">
  <h1>Carrito de Compras</h1>
  <?php if (empty($carrito)) : ?>
    <p>El carrito está vacío. <a href="/productos">¡Compra algo!</a></p>
  <?php else : ?>
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>Producto</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      <?php $total = 0; ?>
      <?php foreach ($carrito as $item) : ?>
        <?php $subtotal = $item['precio'] * $item['cantidad']; ?>
        <?php $total += $subtotal; ?>
        <tr>
          <td><img src="/assets/img/gorras/<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" style="width: 50px;"></td>
          <td><?php echo htmlspecialchars($item['nombre']); ?></td>
          <td><?php echo number_format($item['precio'], 2); ?>€</td>
          <td>
            <form action="/carrito/actualizar" method="post">
              <input type="hidden" name="id_producto" value="<?php echo $item['id']; ?>">
              <input type="number" name="cantidad" value="<?php echo $item['cantidad']; ?>" min="1" class="form-control form-control-sm">
              <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
            </form>
          </td>
          <td><?php echo number_format($subtotal, 2); ?>€</td>
          <td>
            <form action="/carrito/eliminar" method="post">
              <input type="hidden" name="id_producto" value="<?php echo $item['id']; ?>">
              <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
      <tr>
        <td colspan="4" class="text-end fw-bold">Total</td>
        <td><?php echo number_format($total, 2); ?>€</td>
        <td></td>
      </tr>
      </tfoot>
    </table>
    <a href="/pago" class="btn btn-success">Pagar</a>
  <?php endif; ?>
</div>

