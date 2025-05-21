<?= $this->extend('partials/main') ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        padding-left: 300px;
        padding-right: 300px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 400px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('title') ?>
Campaign AIO
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Campaign AIO</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Campaign</li>
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Campaign</h3>
                <button id="createCampaignBtn" data-toggle="modal" class="btn btn-primary">+ Tambah Campaign</button>
            </div>
            <div class="card-body">
                <table id="campaignTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Campaign</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($campaigns as $c): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($c['nama_campaign']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary btn-edit"
                                        data-id="<?= $c['id'] ?>"
                                        data-nama="<?= esc($c['nama_campaign']) ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-delete"
                                        data-id="<?= $c['id'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="addCampaignModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeAddCampaignModal">&times;</span>
            <h3>Tambah Campaign</h3>
            <form method="post" action="<?= base_url('/admin/campaign/saveCampaign') ?>">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="nama_campaign">Nama Campaign</label>
                    <input type="text" class="form-control" name="nama_campaign" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editCampaignModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEditCampaignModal">&times;</span>
            <h3>Edit Campaign</h3>
            <form id="editCampaignForm" method="post" action="">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="edit_nama_campaign">Nama Campaign</label>
                    <input type="text" class="form-control" name="nama_campaign" id="edit_nama_campaign" required>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeDeleteModal">&times;</span>
            <h3>Yakin ingin menghapus?</h3>
            <button id="confirmDeleteBtn" class="btn btn-danger">Hapus</button>
            <button class="btn btn-secondary" id="cancelDeleteBtn">Batal</button>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $('#campaignTable').DataTable();

    // Tambah
    const addModal = document.getElementById("addCampaignModal");
    document.getElementById("createCampaignBtn").onclick = () => addModal.style.display = "block";
    document.getElementById("closeAddCampaignModal").onclick = () => addModal.style.display = "none";

    // Edit
    const editModal = document.getElementById("editCampaignModal");
    const editInput = document.getElementById("edit_nama_campaign");
    const editForm = document.getElementById("editCampaignForm");

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const nama = btn.dataset.nama;

            editInput.value = nama;
            editForm.action = `/campaign/updateCampaign/${id}`;
            editModal.style.display = "block";
        });
    });

    document.getElementById("closeEditCampaignModal").onclick = () => editModal.style.display = "none";

    // Delete
    const deleteModal = document.getElementById("deleteConfirmationModal");
    let deleteId = null;

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', () => {
            deleteId = btn.dataset.id;
            deleteModal.style.display = "block";
        });
    });

    document.getElementById("confirmDeleteBtn").onclick = () => {
        window.location.href = `/campaign/deleteCampaign/${deleteId}`;
    };
    document.getElementById("cancelDeleteBtn").onclick = () => deleteModal.style.display = "none";
    document.getElementById("closeDeleteModal").onclick = () => deleteModal.style.display = "none";

    // Klik luar modal tutup
    window.onclick = (event) => {
        [addModal, editModal, deleteModal].forEach(modal => {
            if (event.target == modal) modal.style.display = "none";
        });
    };
</script>
<?= $this->endSection() ?>