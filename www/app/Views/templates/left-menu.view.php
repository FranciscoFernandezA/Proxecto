<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Inicio -->
    <li class="nav-item">
      <a href="/" class="nav-link <?php echo isset($seccion) && $seccion === '/' ? 'active' : ''; ?>">
        <i class="nav-icon fas fa-th"></i>
        <p>Inicio</p>
      </a>
    </li>

    <!-- ADMIN -->
        <li class="nav-item">
          <a href="/pedidos" class="nav-link <?php echo isset($seccion) && $seccion === '/pedidos' ? 'active' : ''; ?>">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>Lista de Pedidos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/productos/lista" class="nav-link <?php echo isset($seccion) && $seccion === '/productos' ? 'active' : ''; ?>">
            <i class="fas fa-boxes nav-icon"></i>
            <p>Lista de Productos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/productos/nuevo" class="nav-link <?php echo isset($seccion) && $seccion === '/productos/nuevo' ? 'active' : ''; ?>">
            <i class="fas fa-boxes nav-icon"></i>
            <p>Nuevo Producto</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/usuarios" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios' ? 'active' : ''; ?>">
            <i class="fas fa-users nav-icon"></i>
            <p>Lista de Usuarios</p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-list nav-icon"></i>
            <p>Cerrar</p>
          </a>
        </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
