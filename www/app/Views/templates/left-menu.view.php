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

    <!-- CLIENTES -->
    <li class="nav-item <?php echo isset($seccion) && in_array($seccion, ['/registro', '/login']) ? 'menu-open' : ''; ?>">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
          CLIENTES
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/registro" class="nav-link <?php echo isset($seccion) && $seccion === '/registro' ? 'active' : ''; ?>">
            <i class="fas fa-user nav-icon"></i>
            <p>Registrate</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/login" class="nav-link <?php echo isset($seccion) && $seccion === '/login' ? 'active' : ''; ?>">
            <i class="fas fa-user nav-icon"></i>
            <p>Inicia Sesión</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- ADMIN -->
    <li class="nav-item <?php echo isset($seccion) && in_array($seccion, ['/pedidos', '/productos/nuevo', '/productos/card', '/productos', '/usuarios']) ? 'menu-open' : ''; ?>">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-database"></i>
        <p>
          ADMIN
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/pedidos" class="nav-link <?php echo isset($seccion) && $seccion === '/pedidos' ? 'active' : ''; ?>">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>Pedidos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/productos/nuevo" class="nav-link <?php echo isset($seccion) && $seccion === '/productos/nuevo' ? 'active' : ''; ?>">
            <i class="fas fa-boxes nav-icon"></i>
            <p>Nuevo Producto</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/productos/card" class="nav-link <?php echo isset($seccion) && $seccion === '/productos/card' ? 'active' : ''; ?>">
            <i class="fas fa-boxes nav-icon"></i>
            <p>Catálogo adecentado</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/productos" class="nav-link <?php echo isset($seccion) && $seccion === '/productos' ? 'active' : ''; ?>">
            <i class="fas fa-boxes nav-icon"></i>
            <p>Catálogo</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/usuarios" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios' ? 'active' : ''; ?>">
            <i class="fas fa-users nav-icon"></i>
            <p>Usuarios</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
