
<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NoCap Tienda</title>
  <!-- Google Font: Material icons-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <link
    href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/1.0.0/css/font-awesome.css"
    rel="stylesheet"  type='text/css'>

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Select 2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Custom style -->
  <link rel="stylesheet" href="assets/css/nocap.css">
  <!-- Custom style -->
  <script src="assets/js/nocap.js" defer></script>

</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <!-- Navbar-->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <?php if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'admin'){ ?>

          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>

          <?php } ?>
          <li class="nav-item">
            <a href="/" class="nav-link">INICIO</a>
          </li>
          <li class="nav-item">
            <a href="/productos" class="nav-link">TIENDA</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">CATEGORÍAS</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">MARCAS</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">QUIENES SOMOS</a>
          </li>

        </ul>
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="assets/img/cart-shopping-solid.svg" class="icon-cart">
          </a>
          <?php if (!empty($_SESSION['carrito'])) { ?>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <?php foreach ($_SESSION['carrito'] as $item) { ?>
                <a href="#" class="dropdown-item">
                  <div class="media">
                    <img src="/assets/img/gorras/<?php echo htmlspecialchars($item['imagen']); ?>" class="img-size-50 mr-3" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        <?php echo htmlspecialchars($item['nombre']); ?>
                      </h3>
                      <p class="text-sm">Cantidad: <?php echo $item['cantidad']; ?></p>
                      <p class="text-sm text-muted">Precio: <?php echo $item['precio'] * $item['cantidad']; ?>€</p>
                    </div>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
              <?php } ?>
              <a href="/carrito" class="dropdown-item dropdown-footer">Ver Carrito</a>
              <a href="/pedido/confirmar" class="dropdown-item dropdown-footer">Pagar</a>
            </div>
          <?php } else { ?>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <p class="dropdown-item">El carrito está vacío.</p>
            </div>
          <?php } ?>
        </li>
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="assets/img/user-solid.svg" class="icon-user">
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php if(isset($_SESSION['nombre'])){ ?>
            <a href="/mispedidos" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Ver mis pedidos
                    <span class="float-right text-sm text-danger"></span>
                  </h3>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="/logout" class="dropdown-item dropdown-footer">Cerrar Sesión</a>
          </div>
          <?php }else{ ?>
          <a href="/login" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Iniciar Sesion
                  <span class="float-right text-sm text-danger"></span>
                </h3>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="/registro" class="dropdown-item">
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Registrate
  <?php }?>
                </h3>
              </div>
            </div>
          </a>
      </div>
        </li>
      </ul>
    </div>
  </nav>


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <?php
          if (isset($_SESSION['nombre'])): ?>
            <p style="color: white"><?= htmlspecialchars($_SESSION['nombre']); ?></p>
          <?php endif; ?>
        </div>

      </div>

      <?php
      include $_ENV['folder.views'].'/templates/left-menu.view.php';
      ?>
    </div>
    <!-- /.sidebar -->
  </aside>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper cards-back">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php
            echo isset($titulo) ? $titulo : '' ?></h1>
          </div><!-- /.col -->
          <?php

          if(isset($breadcrumb) && is_array($breadcrumb)){
              ?>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <?php

                foreach($breadcrumb as $b){
                ?>
              <li class="breadcrumb-item"><?php echo $b; ?></li>
              <?php
                }?>
            </ol>
          </div><!-- /.col -->
          <?php
          }
          ?>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
