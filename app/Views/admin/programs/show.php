@extends('layouts/main')

@section('content')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="mb-0">Program Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Created Date</dt>
                        <dd class="col-sm-8"><?= date('d/m/Y', strtotime($program['created_at'])) ?></dd>

                        <dt class="col-sm-4">Program Name</dt>
                        <dd class="col-sm-8"><?= $program['name'] ?></dd>

                        <dt class="col-sm-4">Branch</dt>
                        <dd class="col-sm-8">
                            <?php foreach ($program->getMarketplaces() as $mp) : ?>
                                <span class="badge bg-secondary"><?= $mp['name'] ?></span>
                            <?php endforeach ?>
                        </dd>
                    </dl>
                </div>

                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Sales Team</dt>
                        <dd class="col-sm-8">
                            <?php foreach ($program->getSalesTeams() as $st) : ?>
                                <span class="badge bg-info"><?= $st['sales_team'] ?></span>
                            <?php endforeach ?>
                        </dd>

                        <dt class="col-sm-4">Brand</dt>
                        <dd class="col-sm-8"><?= $program->getBrand()['name'] ?></dd>

                        <dt class="col-sm-4">Period</dt>
                        <dd class="col-sm-8">
                            <?= date('d/m/Y', strtotime($program['start_date'])) ?> -
                            <?= date('d/m/Y', strtotime($program['end_date'])) ?>
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="mb-4">
                <h5>Reward Type</h5>
                <p class="fs-5"><?= $program->getReward()['name'] ?></p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Nominal Support</th>
                            <th>Limit Max Qty Claim</th>
                            <th>MOQ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($program->getProducts() as $product) : ?>
                            <tr>
                                <td><?= $product['product_name'] ?></td>
                                <td>Rp<?= number_format($product['reward_value'], 0, ',', '.') ?></td>
                                <td><?= $product['max_qty_claim'] ?? '-' ?></td>
                                <td><?= $product['moq'] ?? '-' ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection