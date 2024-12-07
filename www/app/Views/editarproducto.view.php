<div class="container mt-5">
  <h2>Editar Producto</h2>
  <form action="/productos/editar/<?php echo htmlspecialchars($producto['id_producto']); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
    <div class="form-group">
      <label for="nombre">Nombre del Producto:</label>
      <input type="text" name="nombre" id="nombre" class="form-control"
             value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
    </div>
    <div class="form-group">
      <label for="descripcion">Descripción:</label>
      <textarea name="descripcion" id="descripcion" class="form-control" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
    </div>
    <div class="form-group">
      <label for="precio">Precio:</label>
      <input type="number" step="0.01" name="precio" id="precio" class="form-control"
             value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
    </div>
    <div class="form-group">
      <label for="stock">Stock:</label>
      <input type="number" name="stock" id="stock" class="form-control"
             value="<?php echo htmlspecialchars($producto['stock']); ?>" required>
    </div>
    <div class="form-group">
      <label for="id_categoria">Categoría:</label>
      <select name="id_categoria" id="id_categoria" class="form-control">
        <?php foreach ($categorias as $categoria) { ?>
          <option value="<?php echo $categoria['id_categoria']; ?>"
            <?php echo ($producto['id_categoria'] == $categoria['id_categoria']) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($categoria['nombre']); ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="id_marca">Marca:</label>
      <select name="id_marca" id="id_marca" class="form-control">
        <?php foreach ($marcas as $marca) { ?>
          <option value="<?php echo $marca['id_marca']; ?>"
            <?php echo ($producto['id_marca'] == $marca['id_marca']) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($marca['nombre']); ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    <a href="/productos" class="btn btn-secondary">Cancelar</a>
  </form>
  <?php if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
  <?php } ?>

</div>
