<?php phpinfo(); ?>

<?= $this->extend('partials/main') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $('#spadmTable').DataTable();

    $(document).ready(function() {
        // Initialize DataTable
        const table = $('#spadmTable').DataTable();

        // Filter function based on status
        function filterTable(status) {
            table.column(4).search(status).draw();
        }

        // Event listeners for each box
        $('#boxAll').on('click', function() {
            table.column(4).search('').draw(); // Show all statuses
        });

        $('#boxConfirmed').on('click', function() {
            filterTable('Menunggu Persetujuan');
        });

        $('#boxRejected').on('click', function() {
            filterTable('Ditolak');
        });

        $('#boxApproved').on('click', function() {
            filterTable('Disetujui');
        });
    });
</script>
<?= $this->endSection() ?>