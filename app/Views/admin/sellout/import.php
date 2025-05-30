<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>


<?= $this->extend('partials/main') ?>

<?= $this->section('css') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
    .preview-table th {
        background-color: #f8f9fa;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('title') ?>
Import Data Sell Out
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Import Data Sell Out</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Import Sell Out</li>
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
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info-circle"></i> Program Aktif</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="program-details mb-0">
                            <li><strong>Nama Program:</strong> <?= esc($program['name']) ?></li>
                            <li><strong>Periode:</strong> <?= date('d/m/Y', strtotime($program['start_date'])) ?> - <?= date('d/m/Y', strtotime($program['end_date'])) ?></li>

                            <li><strong>Marketplace:</strong>
                                <?php if (!empty($marketplaces)) : ?>
                                    <?= implode(', ', array_column($marketplaces, 'marketplace_name')) ?>
                                <?php else : ?>
                                    <span class="text-muted">Tidak ada marketplace</span>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="program-details mb-0">
                            <li><strong>Sales Team:</strong>
                                <?php if (!empty($salesTeams)) : ?>
                                    <?= implode(', ', array_column($salesTeams, 'sales_team_name')) ?>
                                <?php else : ?>
                                    <span class="text-muted">Tidak ada sales team</span>
                                <?php endif; ?>
                            </li>
                            <li>
                                <strong>Brand:</strong>
                                <?php if (!empty($brands)) : ?>
                                    <?= $brands['brand_name'] ?? '' ?>
                                <?php else : ?>
                                    <span class="text-muted">Tidak ada brand</span>
                                <?php endif; ?>
                            </li>
                            <li>
                                <strong>Reward:</strong>
                                <?php if (!empty($rewards)) : ?>
                                    <?= $rewards['jenis_reward'] ?? '' ?>
                                <?php else : ?>
                                    <span class="text-muted">Tidak ada reward</span>
                                <?php endif; ?>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tabel Program Products -->
            <div class="mt-4">
                <h5>Daftar Produk & Reward</h5>
                <div class="table-responsive">
                    <table class="table table-bordered program-products">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Nominal Support (Reward)</th>
                                <th>Limit Max Qty Claim</th>
                                <th>MOQ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= esc($product['product_name']) ?></td>
                                    <td><?= 'Rp' . number_format($product['reward_value'], 0, ',', '.') ?></td>
                                    <td><?= $product['max_qty_claim'] ?? '-' ?></td>
                                    <td><?= $product['moq'] ?? '-' ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?= form_open_multipart(route_to('admin.sellout.process-import', $program['id'])) ?>

            <div class="form-group">
                <label>Upload File Excel Sell Out</label>
                <div class="custom-file">
                    <input type="file" name="sellout_file"
                        class="custom-file-input"
                        id="selloutFile"
                        accept=".xlsx,.xls"
                        required>
                    <label class="custom-file-label" for="selloutFile">Pilih file Excel</label>
                </div>
                <small class="form-text text-muted">
                    Format Excel:
                    <a href="/path/to/template.xlsx" class="text-primary">Download Template</a><br>
                    Kolom: Date | Brand | Nama Produk | Quantity | Branch | Sales Team
                </small>
            </div>

            <?php if (isset($importedData)) : ?>
                <div class="mt-4">
                    <h5>Preview Data</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered preview-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Brand</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Cabang</th>
                                    <th>Sales Team</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($importedData as $row): ?>
                                    <tr>
                                        <td><?= esc($row['date']) ?></td>
                                        <td><?= esc($row['brand']) ?></td>
                                        <td><?= esc($row['product']) ?></td>
                                        <td><?= esc($row['quantity']) ?></td>
                                        <td><?= esc($row['branch']) ?></td>
                                        <td><?= esc($row['sales_team']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif ?>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-upload mr-2"></i> Upload Data
                </button>
                <a href="<?= route_to('admin.sellout.report', $program['id']) ?>"
                    class="btn btn-primary btn-lg">
                    <i class="fas fa-chart-bar mr-2"></i> Lihat Laporan
                </a>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        // Update label file input
        $('#selloutFile').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>
<?= $this->endSection() ?>