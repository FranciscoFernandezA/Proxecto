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
    <div class="container my-4 ">
      <h1 class="text-center mb-4"></h1>
      <div class="row row-cols-1 row-cols-md-4 g-4" id="">
      <!-- Card Body -->
        <?php
        if (count($productos) > 0) {
        foreach ($productos as $producto) {
          ?>
          <div class="col card-body product-card" style="margin-bottom: 15px">
            <div class="card h-100 producto">
              <!-- Enlace a la página del producto -->
              <a href="/producto/<?php echo $producto['id_producto']; ?>" style="text-decoration: none;">
                <img src="/assets/img/gorras/<?php echo htmlspecialchars($producto['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
              </a>

              <div class="card-body text-center">
                <h5 class="card-text">
                  <a href="/producto/<?php echo $producto['id_producto']; ?>" class="text-dark" style="text-decoration: none;">
                    <?php echo htmlspecialchars($producto['nombre']); ?>
                  </a>
                </h5>
                <p class="card-text"><?php echo htmlspecialchars($producto['nombre_marca']); ?></p>
                <p class="card-text fw-bold"><?php echo htmlspecialchars($producto['precio']); ?>€</p>
                <button
                  data-product-name="<?php echo htmlspecialchars($producto['nombre']); ?>"
                  data-product-id="<?php echo htmlspecialchars($producto['id_producto']); ?>"
                  class="btn btn-primary add-to-cart">
                  Añadir al carro
                </button>
              </div>
            </div>
          </div>
              <?php
            }
            ?>

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

