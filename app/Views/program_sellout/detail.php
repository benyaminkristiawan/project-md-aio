<?= $this->extend('partials/main') ?>

<?= $this->section('title') ?>
Detail Program Sell Out
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h4><?= esc($program['program_name']) ?></h4>
    <p>Periode: <?= $program['start_date'] ?> s/d <?= $program['end_date'] ?></p>
    <p>Reward: <?= $program['reward_amount'] ?> (<?= esc($program['reward_id']) ?>)</p>
    <p>Total Qty Terjual: <?= $totalQty ?> (MOQ: <?= $program['moq'] ?>)</p>
    <p>Status: <?= $isMoqMet ? '✅ MOQ Tercapai' : '❌ Belum Tercapai' ?></p>

    <hr>
    <h5>Tambah Data Sellout</h5>
    <form action="<?= base_url('admin/program-sellout/store-sellout/' . $program['id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <select name="brand_id" class="form-control">
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?= $brand['id'] ?>"><?= esc($brand['name']) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="type" class="form-control" placeholder="Type">
            </div>
            <div class="col-md-3">
                <input type="number" name="quantity" class="form-control" placeholder="Qty">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <select name="branch_id" class="form-control">
                    <?php foreach ($branches as $b): ?>
                        <option value="<?= $b['id'] ?>"><?= esc($b['location']) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-4">
                <select name="sales_team_id" class="form-control">
                    <?php foreach ($salesTeams as $s): ?>
                        <option value="<?= $s['id'] ?>"><?= esc($s['sales_team']) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </form>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card mt-4">
        <div class="card-header">Import Excel Sellout</div>
        <div class="card-body">
            <form action="<?= base_url('admin/program-sellout/import/' . $program['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-group">
                    <input type="file" name="excel_file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning mt-2">Import Excel</button>
                <a href="<?= base_url('admin/program-sellout/export/' . $program['id']) ?>" class="btn btn-success mt-2">Export Excel</a>
            </form>
        </div>
    </div>


    <hr>
    <h5>Daftar Sellout</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Brand</th>
                <th>Type</th>
                <th>Qty</th>
                <th>Cabang</th>
                <th>Sales</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sellouts as $s): ?>
                <tr>
                    <td><?= $s['date'] ?></td>
                    <td><?= esc($brands[array_search($s['brand_id'], array_column($brands, 'id'))]['name']) ?></td>
                    <td><?= esc($s['type']) ?></td>
                    <td><?= $s['quantity'] ?></td>
                    <td><?= esc($branches[array_search($s['branch_id'], array_column($branches, 'id'))]['location']) ?></td>
                    <td><?= esc($salesTeams[array_search($s['sales_team_id'], array_column($salesTeams, 'id'))]['sales_team']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <a href="/admin/program-sellout"
        class="btn btn-primary <?= (uri_string() == 'admin/program-sellout') ? 'active' : '' ?>">
        <i class="fas fa-list-alt"></i> Simpan
    </a>

</div>
<?= $this->endSection() ?>