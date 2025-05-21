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
    Marketplace AIO
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Marketplace AIO</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/#">Home</a></li>
                        <li class="breadcrumb-item active">Marketplace AIO</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Gerai AIO</h3>
                            <button id="createMarketplaceBtn" class="btn btn-primary ml-auto">+ Tambah Gerai</button>
                        </div>
                        <div class="card-body">
                            <table id="marketplaceTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Lokasi</th>
                                    <th>No. WA</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($marketplaces as $mp): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= esc($mp['location']) ?></td>
                                        <td><?= esc($mp['phone']) ?></td>
                                        <td>
                                            <button class="btn-primary btn btn-edit" data-id="<?= esc($mp['id']) ?>"
                                                    data-location="<?= esc($mp['location']) ?>"
                                                    data-phone="<?= esc($mp['phone']) ?>">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button class="btn-danger btn btn-delete" data-id="<?= esc($mp['id']) ?>">
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

        <!-- Modal for Adding Brand -->
        <div id="MarketplaceModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeMarketplaceModal">&times;</span>
                <h3>Tambah Gerai</h3>
                <form method="post" action="<?= base_url('/superadmin/marketplace/saveMarketplace') ?>" enctype="multipart/form-data">
                    <?=csrf_field()?>
                    <div class="form-group">
                        <label for="location">Lokasi Gerai</label>
                        <input type="text" class="form-control" name="location" placeholder="Lokasi Cabang" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">No. WA</label>
                        <input type="tel" class="form-control" name="phone" placeholder="(628xxxxxx)" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Modal for Editing Brand -->
        <div id="editMarketplaceModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeEditMarketplaceModal">&times;</span>
                <h3>Edit Gerai</h3>
                <form id="editMarketplaceForm" method="post" action="" enctype="multipart/form-data">
                <?=csrf_field()?>
                    <div class="form-group">
                        <label for="location">Lokasi Cabang</label>
                        <input type="text" class="form-control" name="location" id="editMarketplaceLocation"
                        placeholder="Lokasi Cabang" required>
                        <label for="phone">No. WA</label>
                        <input type="tel" class="form-control" name="phone" id="editMarketplacePhone"
                               placeholder="(628xxxxx)" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Modal for Delete Confirmation -->
        <div id="deleteConfirmationModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeDeleteConfirmationModal">&times;</span>
                <h3>Hapus Data ini?</h3>
                <div class="button-container">
                    <button id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
                    <button id="cancelDeleteBtn" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>


<?= $this->section('js') ?>
    <script>

        $('#marketplaceTable').DataTable();
        // Modal for Adding Brand
        var MarketplaceModal = document.getElementById("MarketplaceModal");
        var createBtn = document.getElementById("createMarketplaceBtn");
        var closeMarketplaceModal = document.getElementById("closeMarketplaceModal");

        createBtn.onclick = function () {
            MarketplaceModal.style.display = "block";
        }

        closeMarketplaceModal.onclick = function () {
            MarketplaceModal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == MarketplaceModal) {
                MarketplaceModal.style.display = "none";
            }
        }

        // Modal for Editing Brand
        var editMarketplaceModal = document.getElementById("editMarketplaceModal");
        var closeEditMarketplaceModal = document.getElementById("closeEditMarketplaceModal");

        document.querySelectorAll('.btn-edit').forEach(function (button) {
            button.addEventListener('click', function () {
                var id = this.getAttribute('data-id');
                var location = this.getAttribute('data-location');
                var phone = this.getAttribute('data-phone')

                // Set the form action dynamically
                document.getElementById('editMarketplaceForm').action = '<?= base_url('/superadmin/marketplace/updateMarketplace') ?>/' + id;
                document.getElementById('editMarketplaceLocation').value = location;
                document.getElementById('editMarketplacePhone').value = phone;

                editMarketplaceModal.style.display = "block";
            });
        });

        closeEditMarketplaceModal.onclick = function () {
            editMarketplaceModal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == editMarketplaceModal) {
                editMarketplaceModal.style.display = "none";
            }
        }

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
            window.location.href = "/superadmin/marketplace/deleteMarketplace/" + deleteId; // Adjust as necessary for your delete action
        }

        window.onclick = function (event) {
            if (event.target == deleteConfirmationModal) {
                deleteConfirmationModal.style.display = "none";
            }
        }
    </script>
<?= $this->endSection() ?>