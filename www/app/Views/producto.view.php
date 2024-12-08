<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <img src="assets/img/gorras/<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="img-fluid rounded shadow">
    </div>

    <div class="col-md-6">
      <h1><?php echo htmlspecialchars($producto['nombre']); ?></h1>
      <p class="text-muted"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
      <h2 class="text-success">$<?php echo number_format($producto['precio'], 2); ?></h2>

      <form action="/carrito/agregar" method="post" class="mt-4">
        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
        <div class="mb-3">
          <label for="cantidad" class="form-label">Cantidad:</label>
          <select name="cantidad" id="cantidad" class="form-select" required>
            <?php for ($i = 1; $i <= $producto['stock']; $i++) { ?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="d-flex gap-3">
          <button type="submit" name="accion" value="carrito" class="btn btn-primary">
            <i class="fas fa-cart-plus"></i> Añadir al Carrito
          </button>
          <button type="submit" name="accion" value="comprar" class="btn btn-success">
            <i class="fas fa-credit-card"></i> Comprar Ahora
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

