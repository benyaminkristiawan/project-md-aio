    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:auto; width:100%; position:fixed, margin-bottom:10px;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
         <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
         </a>
      </li>
   </ul>

   <div class="col-sm-6" style="margin-left:100px">
    <a href="/catalog" class="breadcrumb-link" style="font-family: Poppins sans-serif; font-size:18px">Katalog</a> 
    </div><!-- /.col -->

   <!-- User Dropdown -->
   <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
         <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= session()->get('name') ? esc(session()->get('name')) : 'Guest'; ?>
         </a>
         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a href="/reset/reset-password" class="dropdown-item">
               <i class="fas fa-key mr-2"></i> Ganti Password
            </a>
            <div class="dropdown-divider"></div>
            <a href="/logout" class="dropdown-item">
               <i class="fas fa-sign-out-alt mr-2"></i> Log Out
            </a>
         </div>
      </li>
   </ul>
</nav>

<!-- jQuery -->
<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
