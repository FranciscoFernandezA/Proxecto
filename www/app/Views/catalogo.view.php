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
      <form method="get" action="/productos" >
        <div
          class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-lg-3">
              <div class="mb-3">
                <label for="tipo_usuario">Tipo de usuario:</label>
                <select name="tipo_usuario" id="tipo_usuario" class="form-control">
                  <option value="">Todos</option>
                  <option value="admin" <?php echo (isset($input['tipo_usuario']) && $input['tipo_usuario'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                  <option value="cliente" <?php echo (isset($input['tipo_usuario']) && $input['tipo_usuario'] === 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                </select>
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="mb-3">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo isset($input['nombre']) ? $input['nombre'] : ''; ?>" />
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="mb-3">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo isset($input['telefono']) ? $input['telefono'] : ''; ?>" />
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="mb-3">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo isset($input['email']) ? $input['email'] : ''; ?>" />
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="col-12 text-right">
            <a href="/usuarios" class="btn btn-danger">Reiniciar filtros</a>
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
        <h6 class="m-0 font-weight-bold text-primary">Productos</h6>
      </div>
      <div class="card-body" id="card_table">
        <div id="button_container" class="mb-3"></div>
        <?php
        if (count($productos) > 0) {
          ?>
          <table id="tabladatos" class="table table-striped">
            <thead>
            <tr>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Categoría</th>
              <th>Marca</th>
              <th>Fecha de Creación</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($productos as $producto) {
              ?>
              <tr>
                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                <td><?php echo htmlspecialchars(implode(' ', array_slice(explode(' ', $producto['descripcion']), 0, 10))) . (str_word_count($producto['descripcion']) > 10 ? '...' : ''); ?></td>
                <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                <td><?php echo ucfirst($producto['nombre_categoria']); ?></td>
                <td><?php echo ucfirst($producto['nombre_marca']); ?></td>
                <td><?php echo date('d/m/Y H:i:s', strtotime($producto['fecha_creacion'])); ?></td>
                <td>
                  <a href="/productos/editar/<?php echo $producto['id_producto']; ?>" class="btn btn-info btn-sm">Ver/Editar</a>
                </td>
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
