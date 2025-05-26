@extends('partials/main')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Sellout Report</h1>
        <a href="#" class="btn btn-success">
            <i class="fas fa-file-excel me-2"></i>Export Excel
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Nama Produk</th>
                            <th>Quantity</th>
                            <th>Reward</th>
                            <th>Claim per Unit</th>
                            <th>Total Claim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($claims as $claim) : ?>
                            <tr>
                                <td><?= $program->getBrand()['name'] ?></td>
                                <td><?= $claim['product_name'] ?></td>
                                <td><?= $claim['total_quantity'] ?></td>
                                <td><?= $program->getReward()['name'] ?></td>
                                <td>Rp<?= number_format($claim['claim_value'], 0, ',', '.') ?></td>
                                <td>Rp<?= number_format($claim['total_claim'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection