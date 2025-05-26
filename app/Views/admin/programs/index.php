<?= $this->extend('partials/main') ?>

<?= $this->section('css') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #dee2e6;
        padding: 0.375rem 0.75rem;
    }

    .badge {
        font-size: 0.9rem;
        margin: 2px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('title') ?>
Program Sell Out
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Program Sell Out</h1>
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
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Daftar Program</h3>
                    <div class="btn-group">
                        <a href="<?= route_to('admin.programs.create') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus mr-1"></i> Buat Baru
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Program</th>
                                <th>Cabang</th>
                                <th>Sales Team</th>
                                <th>Brand</th>
                                <th>Periode</th>
                                <th>Reward</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programs as $index => $program) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= date('d/m/Y', strtotime($program['created_at'])) ?></td>
                                    <td><?= esc($program['name']) ?></td>
                                    <td>
                                        <?php foreach ($program['marketplaces'] as $mp) : ?>
                                            <span class="badge bg-secondary"><?= $mp['location'] ?></span>
                                        <?php endforeach ?>
                                    </td>
                                    <td>
                                        <?php foreach ($program['sales_teams'] as $st) : ?>
                                            <span class="badge bg-info"><?= $st['sales_team'] ?></span>
                                        <?php endforeach ?>
                                    </td>
                                    <td><?= $program['brand_name'] ?></td>
                                    <td>
                                        <?= date('d/m/Y', strtotime($program['start_date'])) ?> -
                                        <?= date('d/m/Y', strtotime($program['end_date'])) ?>
                                    </td>
                                    <td><?= $program['reward_name'] ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="<?= route_to('admin.sellout.import', $program['id']) ?>"
                                                class="btn btn-sm btn-success"
                                                title="Import Sellout">
                                                <i class="fas fa-file-import"></i>
                                            </a>

                                            <!-- <a href="#"
                                                class="btn btn-sm btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a> -->
                                            <a href="<?= route_to('admin.sellout.report', $program['id']) ?>"
                                                class="btn btn-sm btn-info"
                                                title="Detail Laporan">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="<?= route_to('admin.programs.delete', $program['id']) ?>"
                                                method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin?')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer clearfix">

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih opsi",
            width: '100%'
        });
    });
</script>
<?= $this->endSection() ?>