<?= $this->extend('partials/main') ?>

<?= $this->section('title') ?>
Create Program Sell Out
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h4>Form Program Sell Out</h4>
    <form action="<?= base_url('admin/program-sellout') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label>Program Name</label>
            <input type="text" name="program_name" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
        </div>

        <label>Reward Type</label>
        <select name="reward_id" class="form-control" required>
            <option disabled selected>Pilih Reward</option>
            <?php foreach ($rewards as $reward): ?>
                <option value="<?= $reward['id'] ?>"><?= esc($reward['jenis_reward']) ?></option>
            <?php endforeach ?>
        </select>

        <label>Reward Amount (Rp)</label>
        <input type="number" name="reward_amount" class="form-control" required>

        <label>MOQ</label>
        <input type="number" name="moq" class="form-control" required>

        <button type="submit" class="btn btn-primary mt-3">Create Program</button>
    </form>
</div>
<?= $this->endSection() ?>