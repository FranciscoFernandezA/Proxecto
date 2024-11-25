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
    <div class="container my-4">
      <h1 class="text-center mb-4"></h1>
      <div class="row row-cols-1 row-cols-md-4 g-4" id="">
      <!-- Card Body -->
        <?php
        if (count($productos) > 0) {
        foreach ($productos as $producto) {
          ?>

            <div class="col" style="margin-bottom: 15px">
              <div class="card h-100">
                <img src="/assets/img/cap.jpg" class="card-img-top" alt="">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                  <p class="card-text">Gorra verde tal</p>
                  <p class="card-text fw-bold">15.99€</p>
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

