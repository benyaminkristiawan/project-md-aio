<?= $this->extend('partials/main') ?>

<?= $this->section('css') ?>
<!-- Add any custom styles you need -->
<?= $this->endSection() ?>

<?= $this->section('title') ?>
Reward Management
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Reward Management</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/#">Home</a></li>
                    <li class="breadcrumb-item active">Reward Management</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Reward</h3>
                        <button id="createRewardBtn" class="btn btn-primary ml-auto">+ Tambah Reward</button>
                    </div>
                    <div class="card-body">
                        <table id="rewardTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Reward</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($rewards as $reward): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= esc($reward['jenis_reward']) ?></td>
                                        <td>
                                            <button class="btn-danger btn btn-delete" data-id="<?= esc($reward['id']) ?>">
                                                <i class="fas fa-trash"></i>
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

    <!-- Modal for Adding Reward -->
    <div id="RewardModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeRewardModal">&times;</span>
            <h3>Tambah Reward</h3>
            <form method="post" action="<?= base_url('/admin/reward/saveReward') ?>">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="jenis_reward">Jenis Reward</label>
                    <input type="text" class="form-control" name="jenis_reward" placeholder="Masukkan jenis reward" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    // Modal for Adding Reward
    var RewardModal = document.getElementById("RewardModal");
    var createBtn = document.getElementById("createRewardBtn");
    var closeRewardModal = document.getElementById("closeRewardModal");

    createBtn.onclick = function() {
        RewardModal.style.display = "block";
    }

    closeRewardModal.onclick = function() {
        RewardModal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == RewardModal) {
            RewardModal.style.display = "none";
        }
    }

    // Modal for Delete Confirmation
    var deleteConfirmationModal = document.getElementById("deleteConfirmationModal");
    var confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
    var cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
    var deleteId = null;

    document.querySelectorAll('.btn-delete').forEach(function(button) {
        button.addEventListener('click', function() {
            deleteId = this.getAttribute('data-id');
            deleteConfirmationModal.style.display = "block";
        });
    });

    confirmDeleteBtn.onclick = function() {
        window.location.href = "/admin/reward/deleteReward/" + deleteId;
    }
</script>
<?= $this->endSection() ?>