<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 producto-form">
      <form action="/productos/nuevo" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="precio">Precio</label>
          <input type="text" name="precio" id="precio" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="stock">Stock</label>
          <input type="number" name="stock" id="stock" class="form-control" min="1" required>
        </div>
        <?php if (count($categorias) > 0) { ?>
          <div class="form-group">
            <label for="id_categoria">Categoría</label>
            <select name="id_categoria" id="id_categoria" class="form-control" required>
              <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id_categoria']; ?>"><?= $categoria['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        <?php } else { ?>
          <p>No hay categorías disponibles.</p>
        <?php } ?>

        <?php if (count($marcas) > 0) { ?>
          <div class="form-group">
            <label for="id_marca">Marca</label>
            <select name="id_marca" id="id_marca" class="form-control" required>
              <?php foreach ($marcas as $marca): ?>
                <option value="<?= $marca['id_marca']; ?>"><?= $marca['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        <?php } else { ?>
          <p>No hay marcas disponibles.</p>
        <?php } ?>

        <div class="form-group">
          <label for="imagen">Imagen</label>
          <input type="file" name="imagen" id="imagen" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Agregar Producto</button>
      </form>
    </div>
  </div>
</div>
