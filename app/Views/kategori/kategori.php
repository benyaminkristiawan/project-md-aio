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
Kategori
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/#">Home</a></li>
                    <li class="breadcrumb-item active">Kategori</li>
</ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Kategori</h3>
                        <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addKategoriModal">+ Tambah Kategori</button>
                    </div>
                    <div class="card-body">
                        <table id="kategoriTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kategori</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kategori as $category): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= esc($category['name']) ?></td>
                                    <td>
                                        <button class="btn-primary btn btn-edit" data-toggle="modal" data-target="#editKategoriModal<?= esc($category['id']) ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn-danger btn btn-delete" data-id="<?= esc($category['id']) ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                    </td>
                                </tr>

                                <!-- Edit Kategori Modal -->
                                <div class="modal fade" id="editKategoriModal<?= esc($category['id']) ?>" tabindex="-1" role="dialog" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url('admin/kategori/updateKategori/' . esc($category['id'])) ?>" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Kategori</label>
                                                        <input type="text" class="form-control" name="name" value="<?= esc($category['name']) ?>" placeholder="Enter Kategori Name" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit Kategori Modal -->
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Kategori Modal -->
    <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKategoriModalLabel">Add Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('admin/kategori/saveKategori') ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Kategori</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Kategori Name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
                                </div>
                                </div>

        <div id="deleteConfirmationModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeDeleteConfirmationModal">&times;</span>
                <h3>Hapus Kategori Ini?</h3>
                <div class="button-container">
                    <button id="confirmDeleteBtn" class="btn btn-danger">Hapus</button>
                    <button id="cancelDeleteBtn" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
// Modal for Delete Confirmation
        var deleteConfirmationModal = document.getElementById("deleteConfirmationModal");
        var closeDeleteConfirmationModal = document.getElementById("closeDeleteConfirmationModal");
        var confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
        var cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
        var deleteId = null;

        document.querySelectorAll('.btn-delete').forEach(function (button) {
            button.addEventListener('click', function () {
                deleteId = this.getAttribute('data-id');
                deleteConfirmationModal.style.display = "block";
            });
        });

        closeDeleteConfirmationModal.onclick = function () {
            deleteConfirmationModal.style.display = "none";
        }

        cancelDeleteBtn.onclick = function () {
            deleteConfirmationModal.style.display = "none";
        }

        confirmDeleteBtn.onclick = function () {
            window.location.href = "kategori/deleteKategori/" + deleteId; // Adjust as necessary for your delete action
        }

        window.onclick = function (event) {
            if (event.target == deleteConfirmationModal) {
                deleteConfirmationModal.style.display = "none";
            }
        }

    $(document).ready(function() {
        $('#kategoriTable').DataTable({
          responsive: true
        });
    });
</script>
<?= $this->endSection() ?>