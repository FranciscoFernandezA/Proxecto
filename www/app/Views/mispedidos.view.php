<div class="container mt-5">
<h1 class="text-center">Mis pedidos</h1>
  <h2> <?php echo $nombre; echo " "; echo $apellidos; ?></h2>
    <div class="row">
        <?php if (!empty($pedidos)) : ?>
            <?php foreach ($pedidos as $pedido) : ?>
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            Pedido #<?php echo htmlspecialchars($pedido['id_pedido']); ?>
                        </div>
                        <div class="card-body">
                          <p>Pagado el día : <?php echo date('d-M-Y', strtotime($pedido['fecha_pedido'])); ?></p>
                            <p>Total: $<?php echo number_format($pedido['total'], 2); ?>€</p>
                            <ul>
                                <?php foreach ($pedido['detalles'] as $detalle) : ?>
                                    <li><?php echo htmlspecialchars($detalle['nombre_producto']); ?> x <?php echo $detalle['cantidad']; ?> - <?php echo number_format($detalle['precio_unitario'] * $detalle['cantidad'], 2); ?>€</li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No tienes pedidos aún.</p>
        <?php endif; ?>
    </div>
</div>
