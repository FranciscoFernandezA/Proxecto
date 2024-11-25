<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                DB
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/productos" class="nav-link <?php echo isset($seccion) && $seccion === '/productos' ? 'active' : ''; ?>">
                  <i class="fas fa-boxes nav-icon"></i>
                  <p>Catálogo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/productos" class="nav-link <?php echo isset($seccion) && $seccion === '/productos/card' ? 'active' : ''; ?>">
                  <i class="fas fa-boxes nav-icon"></i>
                  <p>Catálogo adecentado</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/usuarios" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios' ? 'active' : ''; ?>">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/usuarios/ordered" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios/ordered' ? 'active' : ''; ?>">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Ordenados salar</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
