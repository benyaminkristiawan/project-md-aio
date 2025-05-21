<link
  href="static\plugin\font-awesome\css\fontawesome-all.min.css"
  rel="stylesheet" />

<style>
  /* Menambahkan scroll pada sidebar */
  .main-sidebar {
    height: 100vh;
    overflow-y: auto;
  }

  /* Styling tambahan untuk scrollbar */
  .main-sidebar::-webkit-scrollbar {
    width: 8px;
  }

  .main-sidebar::-webkit-scrollbar-thumb {
    background-color: #888;

  }

  .main-sidebar::-webkit-scrollbar-thumb:hover {
    background-color: #555;
  }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <?php if (session()->get('role') == 'superadmin'): ?>
    <a href="/" class="brand-link">
      <img src="/images/logo-aio.png" alt="AIO Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-size:16px">AIO Store SuperAdmin</span>
    </a>
  <?php elseif (session()->get('role') == 'admin'): ?>
    <a href="/" class="brand-link">
      <img src="/images/logo-aio.png" alt="AIO Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-size:16px">AIO Store Admin</span>
    </a>
  <?php else: ?>
    <a href="/" class="brand-link">
      <img src="/images/logo-aio.png" alt="AIO Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-size:16px">AIO Store</span>
    </a>
  <?php endif; ?>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Dashboard -->
      <li class="nav-item">
        <?php if (session()->get('role') == 'superadmin'): ?>
          <!-- Link to Superadmin Dashboard -->
          <a href="/superadmin/dashboard" class="nav-link <?= (uri_string() == 'superadmin/dashboard') ? 'active' : '' ?>">
            <i class="fas fa-home nav-icon"></i>
            <p style="font-size:14px"> Dashboard</p>
          </a>
        <?php elseif (session()->get('role') == 'admin'): ?>
          <!-- Link to Admin Dashboard -->
          <a href="/admin/dashboard" class="nav-link <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
            <i class="fas fa-home nav-icon"></i>
            <p style="font-size:14px">Admin Dashboard</p>
          </a>
        <?php endif; ?>
      </li>



      <?php if (session()->get('role') == 'superadmin' || session()->get('role') == 'admin'): ?>
        <!-- Manage Data Section -->
        <li class="nav-item <?= (uri_string() == 'admin/brand' || uri_string() == 'admin/kategori' || uri_string() == 'admin/subkategori' || uri_string() == 'admin/kapasitas' || uri_string() == 'admin/ukuran' || uri_string() == 'admin/refrigrant') ? 'menu-open' : '' ?>" style="width: 99%">
          <a href="#" class="nav-link <?= (uri_string() == 'admin/brand' || uri_string() == 'admin/kategori' || uri_string() == 'admin/subkategori' || uri_string() == 'admin/kapasitas' || uri_string() == 'admin/ukuran' || uri_string() == 'admin/refrigrant') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Kelola Data<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/brand" class="nav-link <?= (uri_string() == 'admin/brand') ? 'active' : '' ?>">
                <i class="fas fa-tags nav-icon"></i>
                <p>Brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/kategori" class="nav-link <?= (uri_string() == 'admin/kategori') ? 'active' : '' ?>">
                <i class="fas fa-cocktail nav-icon"></i>
                <p>Kategori</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/reward" class="nav-link <?= (uri_string() == 'admin/reward') ? 'active' : '' ?>">
                <i class="fas fa-certificate"></i>
                <p>Tipe Reward</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/campaign" class="nav-link <?= (uri_string() == 'admin/campaign') ? 'active' : '' ?>">
                <i class="fas fa-certificate"></i>
                <p>Jenis Campaign</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Manage User Section, visible only for superadmin -->
        <?php if (session()->get('role') == 'superadmin'): ?>
          <li class="nav-item <?= (uri_string() == 'superadmin/user' || uri_string() == 'superadmin/user/reset') ? 'menu-open' : '' ?>" style="width: 99%">
            <a href="#" class="nav-link <?= (uri_string() == 'superadmin/user' || uri_string() == 'superadmin/user/reset') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>Kelola User<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/superadmin/user" class="nav-link <?= (uri_string() == 'superadmin/user') ? 'active' : '' ?>">
                  <i class="fas fa-user-cog nav-icon"></i>
                  <p>Manajemen User</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'superadmin'): ?>
          <li class="nav-item <?= (uri_string() == 'superadmin/marketplace') ? 'menu-open' : '' ?>" style="width: 99%">
            <a href="#" class="nav-link <?= (uri_string() == 'superadmin/marketplace') ? 'active' : '' ?>">
              <i class="fas fa-map-marked-alt nav-icon"></i>
              <p>Kelola Gerai<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/superadmin/marketplace" class="nav-link <?= (uri_string() == 'superadmin/marketplace') ? 'active' : '' ?>">
                  <i class="fas fa-map-marker-alt nav-icon"></i>
                  <p>Manajemen Gerai</p>
                </a>
              </li>
            <?php endif; ?>
            </ul>
          <?php endif; ?>

          <?php if (session()->get('role') == 'superadmin' || session()->get('role') == 'spvsellin' || session()->get('role') == 'spvsellout'): ?>
          <li class="nav-item">
            <!-- Link Laporan -->
            <a href="/admin/sellin" class="nav-link <?= (uri_string() == 'admin/sellin') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>Data Campaign</p>
            </a>
          </li>

          <li class="nav-item">
            <!-- Link sellout -->
            <a href="/admin/program-sellout" class="nav-link <?= (uri_string() == 'admin/program-sellout') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>Program Sell OUT</p>
            </a>

          </li>
        <?php endif; ?>


  </nav>
</aside>
</div>
<!-- /.sidebar -->

<!-- jQuery -->
<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>