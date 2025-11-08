<?php $ruta = base_url()  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Valeapp</title>
    <base href="<?php echo base_url('public/assets/admin') ?>/">
    <link rel="icon" href="<?= base_url('public/assets/tienda/img/favvale.ico') ?>" type="image/x-icon" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/precio.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.all.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>


</head>

<style>
    .modal-header-admin {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: flex-start;
        -ms-flex-align: start;
        align-items: flex-start;
        -webkit-justify-content: space-between;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 0.8rem;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: calc(0.3rem - 1px);
        border-top-right-radius: calc(0.3rem - 1px);
        background-color: #1B4D9A;
        color: #fff;
    }
</style>



<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <form method="post" action="<?= site_url('sesion/login/logout') ?>">
                    <button type="submit" class="btn btn-danger">Cerrar sesion</button>
                </form>


            </ul>

            <!-- Right navbar links -->

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo $ruta ?>admin" class="brand-link">
                <img src="<?= base_url('public/assets/tienda/img/favvale.ico') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Panel Administrador</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block"><?= session()->username; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                      with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="<?php echo $ruta ?>admin" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Panel
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Pagina Web
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/planes" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Precios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/informacion" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Informacion</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/banner" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/carousel" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Carousel Sistema</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/soporte" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Soporte</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/servicios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Servicios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/clientes_logo" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Clientes Logo</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/testimonios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Testimonios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/respaldo" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Respaldo</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-box"></i>
                                <p>
                                    Tienda Virtual
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/bannertienda" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Banner Tienda</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                <a href="<?= base_url('admin/generarMasivos') ?>" class="nav-link">
                               <i class="far fa-circle nav-icon"></i>
                                <p>Generar Cupones</p>
                              </a>
                              </li>

                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/categoriaspc" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categorias Pc</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/productos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Productos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/compras" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Compras</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/cotizacion" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cotizacion</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/clientes" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Clientes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/ofertas" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ofertas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/ofertasdescuento" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ofertas Descuento</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/usuarios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/review" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reviews</p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Anuncios
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo $ruta ?>admin/anunciotienda" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Anuncio tienda</p>
                                            </a>
                                        </li>


                                    </ul>
                                </li>

                          

                            </ul>
                        </li>

                        <!-- NUEVA SECCIÓN: Productos y Categorías -->
                        <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>
                Catalogo
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?php echo $ruta ?>admin/marcasproductos" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marcas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $ruta ?>admin/categoriaproductos" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Categorias</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $ruta ?>admin/subcategorias" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sub Categorias</p>
                </a>
            </li>
        </ul>
    </li>

                        <!-- Modo Celular -->
                        <li class="nav-item">
                            <a href="<?php echo $ruta ?>admin/modocelular" class="nav-link">
                                <i class="nav-icon fas fa-mobile-alt"></i>
                                <p>
                                    Modo Celular
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/bannertiendaresponsive" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Banner Tienda Celular</p>
                                    </a>
                                </li>

                                   

                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/promocionesresponsive" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categoria Celular</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/masbuscadoresponsive" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mas Buscados Celular</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                      

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p>
                                    Configuracion
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                          
                          
                                <li class="nav-item">
                                    <a href="<?php echo $ruta ?>admin/empresa" class="nav-link">
                                        <i class="fas fa-warehouse nav-icon"></i>
                                        <p>Empresa

                                        </p>
                                    </a>
                                </li>

                               
                               
                            </ul>

                                    <ul class="nav nav-treeview">
                                       
                                 <li class="nav-item">
                                            <a href="<?php echo $ruta ?>admin/configuraciontienda" class="nav-link">
                                                <i class="fas fa-store nav-icon"></i> <!-- Icono de tienda agregado -->
                                                <p>Config. Tienda</p>
                                            </a>
                                </li>




                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!--   <h1 class="m-0">Dashboard</h1> -->
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li> -->
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->