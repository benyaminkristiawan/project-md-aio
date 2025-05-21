<?= $this->extend('partials/main') ?>

<?= $this->section('css') ?>
<!-- Tambahkan CSS kustom jika perlu -->
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
                    <li class="breadcrumb-item"><a href="/#">Home</a></li>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Program</h3>
                        <a href="<?= base_url('admin/program-sellout/create') ?>" class="btn btn-success">+ Create Program</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Program Name</th>
                                    <th>Period</th>
                                    <th>Reward</th>
                                    <th>MOQ</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($programs as $program): ?>
                                    <tr>
                                        <td><?= esc($program['program_name']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($program['start_date'])) ?> - <?= date('d/m/Y', strtotime($program['end_date'])) ?></td>
                                        <td>
                                            <?= esc($program['reward_type'] ?? 'Reward') ?> -
                                            Rp<?= number_format($program['reward_amount'], 0, ',', '.') ?>
                                        </td>
                                        <td><?= esc($program['moq']) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/program-sellout/detail/' . $program['id']) ?>" class="btn btn-primary btn-sm">Detail</a>
                                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?= base_url('admin/program-sellout/delete/' . $program['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this program?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>