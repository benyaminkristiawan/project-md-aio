<?= $this->extend('partials/main') ?>

<?= $this->section('css') ?>
<!-- Add any custom styles if needed -->
<?= $this->endSection() ?>

<?= $this->section('title') ?>
Sellout
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sellout Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/#">Home</a></li>
                    <li class="breadcrumb-item active">Sellout Management</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Data Sellout</h3>
                        <button id="createSelloutBtn" class="btn btn-primary">+ Tambah Sellout</button>
                    </div>
                    <div class="card-body">
                        <table id="selloutTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Cabang/Marketplace</th>
                                    <th>Brand</th>
                                    <th>Kategori</th>
                                    <th>Campaign</th>
                                    <th>Qty Terjual</th>
                                    <th>Nominal Support</th>
                                    <th>Total</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($sellouts as $s): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= esc($s['marketplace_name']) ?></td>
                                        <td><?= esc($s['brand_name']) ?></td>
                                        <td><?= esc($s['category_name']) ?></td>
                                        <td><?= esc($s['campaign_name']) ?></td>
                                        <td><?= esc($s['qty_terjual']) ?></td>
                                        <td>Rp<?= number_format($s['nominal_support'], 0, ',', '.') ?></td>
                                        <td>Rp<?= number_format($s['total'], 0, ',', '.') ?></td>
                                        <td>
                                            <a href="/admin/sellout/edit/<?= $s['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="/admin/sellout/delete/<?= $s['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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

    <!-- Modal untuk Tambah Sellout -->
    <div id="selloutModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeSelloutModal">&times;</span>
            <h3>Tambah Data Sellout</h3>
            <form method="post" action="<?= base_url('/admin/sellout/save') ?>">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>Marketplace</label>
                    <select name="marketplace_id" class="form-control" required>
                        <?php foreach ($marketplaces as $m): ?>
                            <option value="<?= $m['id'] ?>"><?= esc($m['location']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <select name="brand_id" class="form-control" required>
                        <?php foreach ($brands as $b): ?>
                            <option value="<?= $b['id'] ?>"><?= esc($b['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id" class="form-control" required>
                        <?php foreach ($categories as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= esc($c['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Campaign</label>
                    <select name="campaign_id" class="form-control" required>
                        <?php foreach ($jenis_campaign as $cam): ?>
                            <option value="<?= $cam['id'] ?>"><?= esc($cam['nama_campaign']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Qty Terjual</label>
                    <input type="number" class="form-control" name="qty_terjual" required>
                </div>
                <div class="form-group">
                    <label>Nominal Support</label>
                    <input type="text" class="form-control" name="nominal_support" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    var selloutModal = document.getElementById("selloutModal");
    var createBtn = document.getElementById("createSelloutBtn");
    var closeSelloutModal = document.getElementById("closeSelloutModal");

    createBtn.onclick = function() {
        selloutModal.style.display = "block";
    }

    closeSelloutModal.onclick = function() {
        selloutModal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == selloutModal) {
            selloutModal.style.display = "none";
        }
    }
</script>
<?= $this->endSection() ?>