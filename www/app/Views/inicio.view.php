<section class="container my-4">
  <div class="row align-items-center">
    <!-- Columna del Slider -->
    <div class="col-lg-6 col-md-12">
      <div class="slider">
        <div class="slides">
          <div class="slide">
            <a href="/producto/3">
              <img src="assets/img/gorras/black_am.jpg" alt="Imagen 1">
            </a>
          </div>
          <div class="slide">
            <a href="/producto/9">
            <img src="assets/img/gorras/black_nike.jpg" alt="Imagen 2">
            </a>
          </div>
          <div class="slide">
            <a href="/producto/11">
            <img src="assets/img/gorras/black_sox.jpg" alt="Imagen 3">
            </a>
          </div>
          <div class="slide">
            <a href="/producto/4">
            <img src="assets/img/gorras/black_astros.jpg" alt="Imagen 4">
            </a>
          </div>
        </div>
        <div class="prev" onclick="moveSlide(-1)">&#10094;</div>
        <div class="next" onclick="moveSlide(1)">&#10095;</div>
      </div>

    </div>
    <!-- Columna del Texto -->
    <div class="col-lg-6 col-md-12 text-center texto-index" >
      <div class="hero-text">
        <h2>Las Mejores Gorras al Mejor Precio!!</h2>
        <p>
          Descubre nuestra gran colección de gorras, para todas las ocasiones y públicos.
          Consigue la gorrra perfecta para regalar estas Navidades!!
        </p>
        <p>
          Sí existe la gorra perfecta para ti, la encontrarás en nuestra tienda.
        </p>

        <p>
          ¡Haz tu pedido ahora y consigue tú gorra al mejor precio!
        </p>
        <a href="/productos" class="btn btn-primary btn-lg explora">Explorar Productos</a>
      </div>
    </div>
  </div>
</section>





<!-- Enlaces a categorías -->
<section class="container my-5">
  <h3 class="text-center mb-4">Piérdete en nuestras categorías: </h3>
  <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center container-fluid">
    <?php foreach ($categorias as $categoria): ?>
      <div class="col ">
        <a href="/productos?categoria=<?php echo $categoria['id_categoria']; ?>" class="text-decoration-none">
          <div class="card category-card h-100 shadow-sm d-flex align-items-center justify-content-center categoria-card">
            <div class="card-body text-center">
              <h5 class="card-title categoria-title"><?php echo htmlspecialchars($categoria['nombre']); ?></h5>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</section>



<!------------------------------------------------------->
</div>
    </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->


