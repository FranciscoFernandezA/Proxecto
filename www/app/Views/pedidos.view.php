<div class="row">
  <?php
  if (isset($error)) {
    ?>
    <div class="col-12">
      <div class="alert alert-danger"><p><?php echo $error; ?></p></div>
    </div>
    <?php
  }
  ?>
  <div class="col-12">
    <div class="card shadow mb-4">
      <form method="get" action="/pedidos" >
        <div
          class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-lg-3">
              <div class="mb-3">
                <label for="estado">Estado del pedido:</label>
                <select name="estado" id="estado" class="form-control">
                  <option value="">Todos</option>
                  <option value="pagado" <?php echo (isset($input['estado']) && $input['estado'] === 'pagado') ? 'selected' : ''; ?>>Pagado</option>
                  <option value="pendiente" <?php echo (isset($input['estado']) && $input['estado'] === 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                  <option value="enviado" <?php echo (isset($input['estado']) && $input['estado'] === 'enviado') ? 'selected' : ''; ?>>Enviado</option>
                  <option value="entregado" <?php echo (isset($input['estado']) && $input['estado'] === 'entregado') ? 'selected' : ''; ?>>Entregado</option>
                  <option value="cancelado" <?php echo (isset($input['estado']) && $input['estado'] === 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                </select>
              </div>
            </div>
        <div class="card-footer">
          <div class="col-12 text-right">
            <a href="/pedidos" class="btn btn-danger">Reiniciar filtros</a>
            <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-12">
    <div class="card shadow mb-4">
      <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Pedidos</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body" id="card_table">
        <div id="button_container" class="mb-3"></div>
        <?php
        if (count($pedidos) > 0) {
          ?>
          <table id="tabladatos" class="table table-striped">
            <thead>
            <tr>
              <th>ID Pedido</th>
              <th>ID Usuario</th>
              <th>Estado</th>
              <th>Total €</th>
              <th>Fecha pedido</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($pedidos as $pedido) {
              ?>
              <tr>
                <td><?php echo htmlspecialchars($pedido['id_pedido']); ?></td>
                <td><?php echo htmlspecialchars($pedido['id_usuario']); ?></td>
                <td><?php echo htmlspecialchars($pedido['estado']); ?></td>
                <td><?php echo htmlspecialchars($pedido['total']); ?>€</td>
                <td><?php echo date('d/m/Y H:i:s', strtotime($pedido['fecha_pedido'])); ?></td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
          <?php
        } else {
          ?>
          <p class="text-danger">No existen registros que cumplan los requisitos.</p>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
