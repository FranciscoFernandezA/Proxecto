<div class="container mt-4">

  <!-- Detalles del Pedido -->
  <div class="card mb-4">
    <div class="card-header">
      <h5>Detalles del Pedido</h5>
    </div>
    <div class="card-body">
      <table class="table">
        <tr>
          <th>ID Pedido</th>
          <td><?php echo htmlspecialchars($pedido[0]['id_pedido']); ?></td>
        </tr>
        <tr>
          <th> ID Usuario</th>
          <td><?php echo htmlspecialchars($pedido[0]['id_usuario']); ?></td>
        </tr>
        <tr>
          <th> Usuario</th>
          <td><?php echo htmlspecialchars($pedido[0]['nombre']);?> <?php echo htmlspecialchars($pedido[0]['apellidos']);?> </td>
        </tr>
        <tr>
          <th>Estado</th>
          <td><?php echo ucfirst(htmlspecialchars($pedido[0]['estado'])); ?></td>
        </tr>
        <tr>
          <th>Total €</th>
          <td><?php echo htmlspecialchars($pedido[0]['total']); ?>€</td>
        </tr>
        <tr>
          <th>Fecha del Pedido</th>
          <td><?php echo date('d/m/Y H:i:s', strtotime($pedido[0]['fecha_pedido'])); ?></td>
        </tr>
      </table>
    </div>
  </div>

  <!-- Productos del Pedido -->
  <div class="card mb-4">
    <div class="card-header">
      <h5>Productos del Pedido</h5>
    </div>
    <div class="card-body">
      <?php if (!empty($pedido['detalles'])): ?>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario €</th>
            <th>Subtotal €</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($pedido['detalles'] as $producto): ?>
            <tr>
              <td><?php echo htmlspecialchars($producto['nombre_producto']); ?></td>
              <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
              <td><?php echo htmlspecialchars($producto['precio_unitario']); ?>€</td>
              <td><?php echo (htmlspecialchars($producto['cantidad'])*(htmlspecialchars($producto['precio_unitario']))); ?>€</td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No hay productos asociados a este pedido.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Formulario para Actualizar el Estado -->
  <div class="card mb-4">
    <div class="card-header">
      <h5>Actualizar Estado</h5>
    </div>
    <div class="card-body">
      <form method="post" action="/pedidos/editar/<?php echo htmlspecialchars($pedido[0]['id_pedido']); ?>">
        <div class="form-group">
          <label for="estado">Estado del Pedido</label>
          <select name="estado" id="estado" class="form-control">
            <?php foreach ($estadosValidos as $estado): ?>
              <option value="<?php echo $estado; ?>" <?php echo ($pedido[0]['estado'] === $estado) ? 'selected' : ''; ?>>
                <?php echo ucfirst($estado); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Estado</button>
        <a href="/pedidos" class="btn btn-secondary">Cancelar</a>
      </form>
    </div>
  </div>
</div>
