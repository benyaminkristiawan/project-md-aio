<?= $this->extend('partials/main') ?>

<?= $this->section('css') ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('title') ?>
    Antrian Produk
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Antrian Konfirmasi Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/#">Home</a></li>
                        <li class="breadcrumb-item active">Antrian Produk</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Antrian Konfirmasi Produk</h3>
                            <a href="/product/step1" class="btn btn-primary ml-auto">+ Tambah Produk</a>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                    <th>No.</th>
                    <th>Merek</th>
                    <th>Tipe Produk</th>
                    <th>Diajukan Oleh</th>
                    <th>Tanggal</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php $i = 1; ?>
                <?php foreach ($confirmed_products as $products): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= esc($products['brand']) ?></td> <!-- Display Brand Name -->
                <td><?= esc($products['product_type']) ?></td> <!-- Display Category Name -->
                <td><?= esc($products['submitted_by']) ?></td> <!-- Display Subcategory Name -->
                <td><?= esc($products['confirmed_at']) ?></td>
                <td>
    <button class="btn btn-success" 
            onclick="window.open('/superadmin/details/<?= esc($products['id']) ?>', '_blank'); return false;" 
            oncontextmenu="window.location='/superadmin/details/<?= esc($products['id']) ?>'; return false;" 
            title="View Details">
        <i class="fas fa-eye"></i>
    </button>
</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?= $this->endSection() ?>


<?= $this->section('js') ?>
    <script>

        $('#example2').DataTable();

    </script>
<?= $this->endSection() ?>