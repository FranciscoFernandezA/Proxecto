<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <img src="assets/img/gorras/<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="img-fluid rounded shadow img-producto">
    </div>

    <div class="col-md-6">
      <h1><?php echo htmlspecialchars($producto['nombre']); ?></h1>
      <p class="text-muted"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
      <h2 class="text-success precio"><?php echo number_format($producto['precio'], 2); ?> €</h2>

      <form action="" method="" class="mt-4">
        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
        <div class="mb-3">
          <label for="cantidad" class="form-label">Cantidad:</label>
          <select name="cantidad" id="cantidad" class="cantidad form-select" required>
            <?php for ($i = 1; $i <= $producto['stock']; $i++) { ?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="d-flex gap-3">
          <button type="button" class="btn btn-primary add-to-cart cartahora"
                  data-product-name="<?php echo htmlspecialchars($producto['nombre']); ?>"
                  data-product-id="<?php echo htmlspecialchars($producto['id_producto']); ?>">
            <i class="fas fa-cart-plus"></i> Añadir al Carrito
          </button>



          <a href="/carrito" class="btn btn-success enlace-carrito  compraahora">
            Ir al Carrito
          </a>

        </div>
      </form>
    </div>

  </div>

