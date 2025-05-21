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
Brand
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Brand</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/#">Home</a></li>
                    <li class="breadcrumb-item active">Brand</li>
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
                        <h3 class="card-title">Daftar Merek</h3>
                        <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addBrandModal">+ Tambah Merek</button>
                    </div>
                    <div class="card-body">
                        <table id="brandTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Merek</th>
                                    <th>Merek</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($brand as $merk): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= esc($merk['code']) ?></td>
                                    <td><?= esc($merk['name']) ?></td>
                                    <td>
                                        <button class="btn-primary btn btn-edit" data-toggle="modal" data-target="#editBrandModal<?= esc($merk['id']) ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn-danger btn btn-delete" data-id="<?= esc($merk['id']) ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                    </td>
                                </tr>

                                <!-- Edit Brand Modal -->
                                <div class="modal fade" id="editBrandModal<?= esc($merk['id']) ?>" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url('admin/brand/updateBrand/' . esc($merk['id'])) ?>" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="code">Kode Merek</label>
                                                        <input type="text" class="form-control" name="code" value="<?= esc($merk['code']) ?>" placeholder="Enter Brand Code" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Merek</label>
                                                        <input type="text" class="form-control" name="name" value="<?= esc($merk['name']) ?>" placeholder="Enter Brand Name" required>
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
                                <!-- End Edit Brand Modal -->
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Brand Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalLabel">Add Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('admin/brand/saveBrand') ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Kode Merek</label>
                            <input type="text" class="form-control" name="code" placeholder="Enter Brand Code" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Merek</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Brand Name" required>
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
                <h3>Hapus Merek Ini?</h3>
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
            window.location.href = "brand/deleteBrand/" + deleteId; // Adjust as necessary for your delete action
        }

        window.onclick = function (event) {
            if (event.target == deleteConfirmationModal) {
                deleteConfirmationModal.style.display = "none";
            }
        }

    $(document).ready(function() {
        $('#brandTable').DataTable({
          responsive: true
        });
    });
</script>
<?= $this->endSection() ?>
