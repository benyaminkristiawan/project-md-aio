<?= $this->extend('partials/main') ?>
<?= $this->section('content') ?>

<div class="container my-4">
    <h2 class="mb-4">Data Campaign</h2>

    <!-- Form Data Campaign -->
    <form action="<?= base_url('admin/sellin/create') ?>" method="post" class="mb-5">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="brand_id" class="form-label">Nama Brand</label>
                <select class="form-select" name="brand_id" required>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="jenis_campaign_id" class="form-label">Jenis Campaign</label>
                <select class="form-select" name="jenis_campaign_id" required>
                    <?php foreach ($campaign_types as $type): ?>
                        <option value="<?= $type['id'] ?>"><?= $type['nama_campaign'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="branch_id" class="form-label">Cabang</label>
                <select class="form-select" name="branch_id" required>
                    <?php foreach ($branches as $branch): ?>
                        <option value="<?= $branch['id'] ?>"><?= $branch['location'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="ppn" class="form-label">PPN</label>
                <select class="form-select" name="ppn" required>
                    <option value="yes">Ya</option>
                    <option value="no">Tidak</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="campaign_name" class="form-label">Nama Campaign</label>
                <input type="text" class="form-control" name="campaign_name" required>
            </div>
            <div class="col-md-3">
                <label for="category_id" class="form-label">Kategori Produk</label>
                <select class="form-select" name="category_id" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="start_date" class="form-label">Periode Start</label>
                <input type="date" class="form-control" name="start_date">
            </div>
            <div class="col-md-3">
                <label for="pph" class="form-label">PPh</label>
                <select class="form-select" name="pph">
                    <option value="yes">Ya</option>
                    <option value="no">Tidak</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="support_category_id" class="form-label">Kategori Support</label>
                <select name="support_category_id" class="form-select">
                    <?php foreach ($support_categories as $support): ?>
                        <option value="<?= $support['id'] ?>"><?= $support['campaign_type'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="col-md-4">
                <label for="subcategory_id" class="form-label">Subkategori Produk</label>
                <select name="subcategory_id" class="form-select">
                    <?php foreach ($subcategories as $sub): ?>
                        <option value="<?= $sub['id'] ?>"><?= $sub['name'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Periode End</label>
                <input type="date" class="form-control" name="end_date">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Campaign</button>
    </form>

    <hr>

    <!-- Form Detail Product -->
    <h4 class="mb-3">Tambah Produk</h4>
    <form action="<?= base_url('sellin/add-detail') ?>" method="post" class="mb-4">
        <input type="hidden" name="program_id" value="<?= session('program_id') ?>">

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="no_sj" class="form-label">No SJ</label>
                <input type="text" class="form-control" name="no_sj" required>
            </div>
            <div class="col-md-3">
                <label for="product_id" class="form-label">Product Name</label>
                <select class="form-select" name="product_id">
                    <!-- Isi data produk -->
                </select>
            </div>
            <div class="col-md-2">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" min="1" required>
            </div>
            <div class="col-md-2">
                <label for="unit_price" class="form-label">Unit Price</label>
                <input type="text" class="form-control" readonly value="Auto-generate">
            </div>
            <div class="col-md-2">
                <label for="harga_dpp" class="form-label">Harga DPP</label>
                <input type="text" class="form-control" readonly value="Auto-generate">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="harga_dasar" class="form-label">Harga Dasar</label>
                <input type="text" class="form-control" readonly value="Auto-generate">
            </div>
            <div class="col-md-3">
                <label for="reward" class="form-label">Reward</label>
                <input type="text" class="form-control" readonly value="Auto-rumus">
            </div>
            <div class="col-md-3">
                <label for="total_reward" class="form-label">Total Reward</label>
                <input type="text" class="form-control" readonly value="Auto: Qty * Reward">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">Add Detail</button>
            </div>
        </div>
    </form>

    <hr>

    <!-- Tabel Hasil Input -->
    <h4>Hasil Input</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No SJ</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Harga DPP</th>
                    <th>Harga Dasar</th>
                    <th>Reward</th>
                    <th>Total Reward</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($details) && count($details) > 0): ?>
                    <?php foreach ($details as $row): ?>
                        <tr>
                            <td><?= $row['no_sj'] ?></td>
                            <td><?= $row['product_name'] ?></td>
                            <td><?= $row['quantity'] ?></td>
                            <td><?= $row['unit_price'] ?></td>
                            <td><?= $row['harga_dpp'] ?></td>
                            <td><?= $row['harga_dasar'] ?></td>
                            <td><?= $row['reward'] ?></td>
                            <td><?= $row['total_reward'] ?></td>
                            <td>
                                <a href="<?= base_url('sellin/delete-detail/' . $row['id']) ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- <p class="mt-3"><strong>Hasil cetak surat konfirmasi hutang:</strong> <em>masih proses</em></p> -->

    <!-- Submit Final -->
    <form action="<?= base_url('sellin/submit') ?>" method="post" class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan Semua</button>
    </form>
</div>

<?= $this->endSection() ?>