<div class="container mt-4">

  <h4>Resumen del Pedido</h4>
  <table class="table">
    <thead>
    <tr>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Precio Unitario</th>
      <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($carrito as $item): ?>
      <tr>
        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
        <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
        <td><?php echo htmlspecialchars(number_format($item['precio'], 2)); ?>€</td>
        <td><?php echo htmlspecialchars(number_format($item['precio'] * $item['cantidad'], 2)); ?>€</td>
      </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
      <th colspan="3" class="text-right">Total:</th>
      <th><?php echo htmlspecialchars(number_format($total, 2)); ?>€</th>
    </tr>
    </tfoot>
  </table>

  <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger">
      <?= $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>
  <form action="/pedido/crear" method="POST">
    <div class="form-group">
      <label for="metodo_pago">Método de Pago:</label>
      <select name="id_metodo_pago" id="metodo_pago" class="form-control" required>
        <option value="">Seleccione un método de pago</option>
        <?php foreach ($metodosPago as $metodo): ?>
          <option value="<?php echo htmlspecialchars($metodo['id_metodo_pago']); ?>">
            <?php echo htmlspecialchars($metodo['nombre']); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Finalizar Pedido</button>
  </form>
</div>
