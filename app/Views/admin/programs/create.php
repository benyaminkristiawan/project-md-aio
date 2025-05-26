<?= $this->extend('partials/main') ?>

<?= $this->section('css') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #dee2e6;
        padding: 0.375rem 0.75rem;
    }

    .file-input-label {
        cursor: pointer;
        border: 2px dashed #dee2e6;
        padding: 2rem;
        text-align: center;
        border-radius: 0.5rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('title') ?>
Buat Program Baru
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Buat Program Sell Out Baru</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Program Sell Out</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <?= form_open_multipart(route_to('admin.programs.store')) ?>

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Program</label>
                        <input type="text" name="name" class="form-control" required
                            placeholder="Contoh: Program Cashback Q3 2024">
                    </div>

                    <div class="form-group">
                        <label>Branch</label>
                        <select name="marketplaces[]" class="form-control select2" multiple required>
                            <?php foreach ($marketplaces as $mp) : ?>
                                <option value="<?= $mp['id'] ?>"><?= esc($mp['location']) ?></option>
                            <?php endforeach ?>
                        </select>
                        <small class="text-muted">Pilih cabang yang berlaku</small>
                    </div>

                    <div class="form-group">
                        <label>Sales Team</label>
                        <select name="sales_teams[]" class="form-control select2" multiple required>
                            <?php foreach ($salesTeams as $st) : ?>
                                <option value="<?= $st['id'] ?>"><?= esc($st['sales_team']) ?></option>
                            <?php endforeach ?>
                        </select>
                        <small class="text-muted">Pilih team yang terlibat</small>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand_id" class="form-control" required>
                            <?php foreach ($brands as $brand) : ?>
                                <option value="<?= $brand['id'] ?>"><?= esc($brand['name']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Periode Program</label>
                        <div class="input-group">
                            <input type="date" name="start_date" class="form-control" required
                                placeholder="Tanggal Mulai">
                            <div class="input-group-append">
                                <span class="input-group-text">s/d</span>
                            </div>
                            <input type="date" name="end_date" class="form-control" required
                                placeholder="Tanggal Berakhir">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jenis Reward</label>
                        <select name="reward_id" class="form-control" required>
                            <?php foreach ($rewards as $reward) : ?>
                                <option value="<?= $reward['id'] ?>"><?= esc($reward['jenis_reward']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Import Daftar Produk</label>
                        <div class="custom-file">
                            <input type="file" name="products_file"
                                class="custom-file-input"
                                id="productsFile"
                                accept=".xlsx,.xls"
                                required>
                            <label class="custom-file-label" for="productsFile">Pilih file Excel</label>
                        </div>
                        <small class="form-text text-muted">
                            Format Excel:
                            <a href="/path/to/template.xlsx" class="text-primary">Download Template</a><br>
                            Kolom: Nama Produk | Nominal Support | Limit Max Qty Claim | MOQ
                        </small>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save mr-2"></i> Simpan Program
                </button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productsFile').on('change', function() {
            // dapatkan nama file
            var fileName = $(this).val().split('\\').pop();
            // update label
            $(this).next('.custom-file-label').html(fileName || 'Pilih file Excel');
        });
        // Inisialisasi Select2
        $('.select2').select2({
            placeholder: "Pilih opsi",
            width: '100%'
        });
        // Inisialisasi datepicker
        flatpickr('input[type="date"]', {
            dateFormat: 'Y-m-d',
            locale: 'id'
        });
    });
</script>
<?= $this->endSection() ?>