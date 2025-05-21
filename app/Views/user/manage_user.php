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
Pengelolaan User
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengelolaan User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/#">Home</a></li>
                    <li class="breadcrumb-item active">Pengelolaan User</li>
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
                        <h3 class="card-title">Daftar User</h3>
                        <a href="/superadmin/user/addUser" class="btn btn-primary ml-auto">+ Tambah User</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- Flash message (place this above the table, outside the loop) -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <table id="user" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Username</th>

                                    <th>No.Telp</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Role</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($user as $users): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= esc($users['name']) ?></td>
                                        <td><?= esc($users['username']) ?></td>

                                        <td><?= esc($users['phone']) ?></td>
                                        <td><?= esc($users['email']) ?></td>
                                        <td><?= esc($users['address']) ?></td>
                                        <td><?= esc($users['role']) ?></td>
                                        <td>
                                            <a href="/superadmin/user/editUser/<?= esc($users['id']) ?>" class="btn-primary btn btn-edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button class="btn-danger btn btn-delete" data-toggle="modal" data-target="#deleteModal" data-id="<?= esc($users['id']) ?>" data-name="<?= esc($users['name']) ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form action="/superadmin/user/resetPassword/<?= esc($users['id']) ?>" method="post" style="display:inline;">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn-warning btn btn-reset" onclick="return confirm('Ganti Password <?= esc($users['name']) ?>?')">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </form>
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
</section>
<div id="deleteConfirmationModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeDeleteConfirmationModal">&times;</span>
        <h3>Hapus <span id="deleteUserName"></span> ?</h3>
        <div class="button-container">
            <button id="confirmDeleteBtn" class="btn btn-danger">Hapus</button>
            <button id="cancelDeleteBtn" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</div>
</section>
<?= $this->endSection() ?>




<?= $this->section('js') ?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script>
    // Modal for Delete Confirmation
    var deleteConfirmationModal = document.getElementById("deleteConfirmationModal");
    var closeDeleteConfirmationModal = document.getElementById("closeDeleteConfirmationModal");
    var confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
    var cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
    var deleteId = null;
    var deleteName = null;

    document.querySelectorAll('.btn-delete').forEach(function(button) {
        button.addEventListener('click', function() {
            deleteId = this.getAttribute('data-id');
            deleteName = this.getAttribute('data-name'); // Fetch the username
            deleteConfirmationModal.style.display = "block";

            // Update the modal with the username
            document.getElementById('deleteUserName').textContent = deleteName;
        });
    });


    closeDeleteConfirmationModal.onclick = function() {
        deleteConfirmationModal.style.display = "none";
    }

    cancelDeleteBtn.onclick = function() {
        deleteConfirmationModal.style.display = "none";
    }

    confirmDeleteBtn.onclick = function() {
        window.location.href = "/superadmin/user/deleteUser/" + deleteId; // Adjust as necessary for your delete action
    }

    window.onclick = function(event) {
        if (event.target == deleteConfirmationModal) {
            deleteConfirmationModal.style.display = "none";
        }
    }

    $(document).ready(function() {
        var table = $('#user').DataTable();
        table.destroy(); // Destroy existing DataTable instance

        $('#user').DataTable({
            "paging": true,
            "pageLength": 10,
            "searching": true,
            "ordering": true,
            "info": true,
            "responsive": true
        });
    });
</script>
<?= $this->endSection() ?>