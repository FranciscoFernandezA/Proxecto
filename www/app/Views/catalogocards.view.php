<div class="container my-4">
  <!-- Filtros -->
  <div class="card card-filtro mb-4">
    <div class="card-body card-body-filtro">
      <form method="get" action="/productos">
        <div class="row g-3 align-items-center ">
          <!-- Filtro de categoría -->
          <div class="col-12 col-md-3">
            <select name="categoria" id="categoria" class="form-control">
              <option value="">Categorías</option>
              <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id_categoria']; ?>"
                  <?php echo (isset($input['categoria']) && $input['categoria'] == $categoria['id_categoria']) ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($categoria['nombre']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Filtro de marca -->
          <div class="col-12 col-md-3">
            <select name="marca" id="marca" class="form-control">
              <option value="">Marcas</option>
              <?php foreach ($marcas as $marca): ?>
                <option value="<?php echo $marca['id_marca']; ?>"
                  <?php echo (isset($input['marca']) && $input['marca'] == $marca['id_marca']) ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($marca['nombre']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Filtro por precio -->
          <div class="col-12 col-md-3">
            <select name="orden_precio" id="orden_precio" class="form-control">
              <option value="">Ordenar</option>
              <option value="asc" <?php echo (isset($input['orden_precio']) && $input['orden_precio'] === 'asc') ? 'selected' : ''; ?>>Menor a Mayor</option>
              <option value="desc" <?php echo (isset($input['orden_precio']) && $input['orden_precio'] === 'desc') ? 'selected' : ''; ?>>Mayor a Menor</option>
            </select>
          </div>

          <div class="col-12 col-md-3">
          <input type="text" class="form-control me-2" name="nombre" id="nombre"
                 value="<?php echo isset($input['nombre']) ? htmlspecialchars($input['nombre']) : ''; ?>"
                 placeholder="Buscar producto">
          </div>

        </div>



        <!-- Campo de búsqueda y botones -->
        <div class="col-12 col-md-6 d-flex">

          <a href="/productos" class="btn btn-danger me-2 borrar">Borrar</a>
          <button type="submit" class="btn btn-primary aplicar" >Aplicar</button>
        </div>


      </form>
    </div>
  </div>

  <!-- Catálogo de productos -->
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    <?php if (count($productos) > 0): ?>
      <?php foreach ($productos as $producto): ?>
        <?php if ($producto['stock'] > 0): ?>
          <div class="col">
            <div class="card h-100 producto">
              <a href="/producto/<?php echo $producto['id_producto']; ?>">
                <img src="/assets/img/gorras/<?php echo htmlspecialchars($producto['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
              </a>
              <div class="card-body text-center">
                <h5 class="card-text">
                  <a href="/producto/<?php echo $producto['id_producto']; ?>" class="text-dark">
                    <?php echo htmlspecialchars($producto['nombre']); ?>
                  </a>
                </h5>
                <p class="card-text"><?php echo htmlspecialchars($producto['nombre_marca']); ?></p>
                <p class="card-text fw-bold"><?php echo htmlspecialchars($producto['precio']); ?>€</p>
                <button
                  data-product-name="<?php echo htmlspecialchars($producto['nombre']); ?>"
                  data-product-id="<?php echo htmlspecialchars($producto['id_producto']); ?>"
                  class="btn btn-primary add-to-cart">
                  Añadir al carrito
                </button>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-danger text-center">No existen registros que cumplan los requisitos.</p>
    <?php endif; ?>
  </div>
</div>
