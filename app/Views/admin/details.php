<?= $this->extend('partials/main') ?>

<?= $this->section('title') ?>
Rincian Produk
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Rincian Produk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/#">Home</a></li>
                    <li class="breadcrumb-item active">Rincian Produk</li>
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
        <table class="table">
            <tr>
                <th>Brand</th>
                <td><?= esc($product['brand']) ?></td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td><?= esc($product['category']) ?></td>
            </tr>
            <tr>
                <th>Subkategori</th>
                <td><?= esc($product['subcategory']) ?></td>
            </tr>
            <tr>
                <th>Tipe Produk</th>
                <td><?= esc($product['product_type']) ?></td>
            </tr>
            <!--harga <?php if ($product['status'] == 'approved'): ?>
                    <tr><th>Harga</th>
                    <?php if ($product['harga'] != null): ?>
        <td><?= esc($product['harga']) ?></td></tr>
        <?php elseif ($product['harga'] == null): ?>
        <td>Belum Ditentukan</td></tr>
        <?php endif; ?>
        <?php endif; ?>-->
            <!--harga <?php if ($product['status'] == 'approved'): ?>
                    <tr><th>Harga</th>
                    <?php if ($product['harga'] != null): ?>
        <td><?= esc($product['harga']) ?></td></tr>
        <?php elseif ($product['harga'] == null): ?>
        <td>Belum Ditentukan</td></tr>
        <?php endif; ?>
        <?php endif; ?>-->
            <tr>
                <th>Warna</th>
                <td><?= esc($product['color']) ?></td>
            </tr>
            <tr>
                <th>Dimensi Produk</th>
                <td><?= esc($product['product_dimensions']) ?></td>
            </tr>
            <tr>
                <th>Dimensi Kemasan</th>
                <td><?= esc($product['packaging_dimensions']) ?></td>
            </tr>
            <tr>
                <th>Konsumsi Daya</th>
                <td><?= esc($product['daya']) ?> Watt</td>
            </tr>
            <tr>
                <th>Berat Produk</th>
                <td><?= esc($product['berat']) ?> Kg</td>
            </tr>
            <tr>
                <th>Negara Pembuat</th>
                <td><?= esc($product['pembuat']) ?></td>
            </tr>
            <tr>
                <th>Keunggulan</th>
                <td>
                    <?= esc($product['advantage1']) ?><br>
                    <?= esc($product['advantage2']) ?><br>
                    <?= esc($product['advantage3']) ?><br>
                    <?= esc($product['advantage4']) ?><br>
                    <?= esc($product['advantage5']) ?><br>
                    <?= esc($product['advantage6']) ?></td>
            </tr>
            <tr>
                <th>Foto Produk</th>
                <td>
                    <a href="<?= base_url('uploads/' . esc($product['gambar_depan'])) ?>" target="_blank">Gambar
                        Depan</a><br>
                    <a href="<?= base_url('uploads/' . esc($product['gambar_belakang'])) ?>" target="_blank">Gambar
                        Belakang</a><br>
                    <a href="<?= base_url('uploads/' . esc($product['gambar_atas'])) ?>" target="_blank">Gambar
                        Atas</a><br>
                    <a href="<?= base_url('uploads/' . esc($product['gambar_bawah'])) ?>" target="_blank">Gambar
                        Bawah</a><br>
                    <a href="<?= base_url('uploads/' . esc($product['gambar_samping_kiri'])) ?>" target="_blank">Gambar
                        Samping Kiri</a><br>
                    <a href="<?= base_url('uploads/' . esc($product['gambar_samping_kanan'])) ?>" target="_blank">Gambar
                        Samping Kanan</a>
                </td>
            </tr>
            <tr>
                <th>Video Produk</th>
                <td><a href="<?= esc($product['video_produk']) ?>"
                        target="_blank"><?= esc($product['video_produk']) ?></a></td>
            </tr>
            <tr>
                <th>Diajukan Oleh</th>
                <td><?= esc($product['submitted_by']) ?></td>
            </tr>
            <tr>
                <th>Tanggal Diajukan</th>
                <td><?= esc($product['confirmed_at']) ?></td>
            </tr>
            <!-- Conditional Fields -->
            <?php if ($product['category'] == 'TV'): ?>
            <!-- For category TV (ID 9): Display "dimensi produk dengan stand" and "resolusi panel" -->
            <tr>
                <th>Dimensi Produk dengan Stand</th>
                <td><?= esc($product['pstand_dimensions']) ?> cm</td>
            </tr>
            <tr>
                <th>Ukuran</th>
                <td><?= esc($product['ukuran']) ?></td>
            </tr>
            <tr>
                <th>Resolusi Panel</th>
                <td><?= esc($product['panel_resolution']) ?> Pixel</td>
            </tr>
            <tr>
                <th>Garansi Panel</th>
                <td><?= esc($product['garansi_panel']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['sparepart_warranty']) ?> Tahun</td>
            </tr>
            <?php endif; ?>

            <?php if ($product['category'] == 'AC'): ?>
            <!-- For category AC (ID 3): Display "kapasitas pendinginan", "cspf rating", "tipe refrigerant" -->
            <tr>
                <th>Kapasitas Pendinginan</th>
                <td><?= esc($product['cooling_capacity']) ?> BTU/h</td>
            </tr>
            <tr>
                <th>Kapasitas</th>
                <td><?= esc($product['capacity']) ?></td>
            </tr>
            <tr>
                <th>Garansi Kompresor</th>
                <td><?= esc($product['compressor_warranty']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Tipe Refrigerant</th>
                <td><?= esc($product['refrigrant']) ?></td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['sparepart_warranty']) ?> Tahun</td>
            </tr>
            <tr>
                <th>CSPF Rating</th>
                <td>
                    <?= esc($product['cspf']) ?>/5
                    <?php if ($product['cspf'] == 5): ?>
                    <img src="<?= base_url('/images/5stars.png') ?>" alt="cspf-star" style="height:35px; padding: 5px">
                    <?php elseif ($product['cspf'] >= 4.00 && $product['cspf'] < 5): ?>
                    <img src="<?= base_url('/images/4stars.png') ?>" alt="cspf-star" style="height:35px; padding: 5px">
                    <?php elseif ($product['cspf'] >= 3.00 && $product['cspf'] < 4.00): ?>
                    <img src="<?= base_url('/images/3stars.png') ?>" alt="cspf-star" style="height:35px; padding: 5px">
                    <?php elseif ($product['cspf'] >= 2.00 && $product['cspf'] < 3.00): ?>
                    <img src="<?= base_url('/images/2stars.png') ?>" alt="cspf-star" style="height:35px; padding: 5px">
                    <?php elseif ($product['cspf'] >= 1.00 && $product['cspf'] < 2.00): ?>
                    <img src="<?= base_url('/images/1star.png') ?>" alt="cspf-star" style="height:35px; padding: 5px">
                    <?php endif; ?>
                </td>
            </tr>
            <?php endif; ?>
            <?php if ($product['category'] == 'KULKAS' || $product['category'] == 'FREEZER' || $product['category'] == 'SHOWCASE' ): ?>
            <tr>
                <th>Kapasitas</th>
                <td><?= esc($product['capacity']) ?></td>
            </tr>
            <tr>
                <th>Garansi Kompresor</th>
                <td><?= esc($product['compressor_warranty']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['sparepart_warranty']) ?> Tahun</td>
            </tr>
            <?php endif; ?>


            <?php if ($product['category'] == 'MESIN CUCI' || $product['subcategory'] == 'BLENDER'  || $product['subcategory'] == 'JUICER' || $product['subcategory'] == 'CHOPPER'): ?>
            <tr>
                <th>Kapasitas</th>
                <td><?= esc($product['capacity']) ?></td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['sparepart_warranty']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Motor</th>
                <td><?= esc($product['garansi_motor']) ?> Tahun</td>
            </tr>
            <?php endif; ?>

            <?php if ($product['subcategory'] == 'SPEAKER'): ?>
            <tr>
                <th>Ukuran</th>
                <td><?= esc($product['ukuran']) ?></td>
            </tr>
            <tr>
                <th>Garansi Semua Service</th>
                <td><?= esc($product['garansi_semua_service']) ?> Tahun</td>
            </tr>
            <?php endif; ?>

            <?php if ($product['subcategory'] == 'KIPAS ANGIN'): ?>
            <tr>
                <th>Ukuran</th>
                <td><?= esc($product['ukuran']) ?></td>
            </tr>
            <tr>
                <th>Garansi Motor</th>
                <td><?= esc($product['garansi_motor']) ?> Tahun</td>
            </tr>
            <?php endif; ?>

            <?php if ($product['subcategory'] == 'MIXER' || $product['subcategory'] == 'HAND MIXER'): ?>
            <tr>
                <th>Garansi Motor</th>
                <td><?= esc($product['garansi_motor']) ?> Tahun</td>
            </tr>
            <?php endif; ?>

            <?php if ($product['subcategory'] == 'DISPENSER GALON ATAS' || $product['subcategory'] == 'DISPENSER GALON BAWAH'): ?>
            <tr>
                <th>Kapasitas Air Dingin</th>
                <td><?= esc($product['kapasitas_air_dingin']) ?> Liter</td>
            </tr>
            <tr>
                <th>Kapasitas Air Panas</th>
                <td><?= esc($product['kapasitas_air_panas']) ?> Liter</td>
            </tr>
            <tr>
                <th>Garansi Kompresor</th>
                <td><?= esc($product['compressor_warranty'])?> Tahun</td>
            </tr>
            <?php endif; ?>

            <?php if ($product['subcategory'] == 'MOTOR LISTRIK'): ?>
            <tr>
                <th>Kapasitas Baterai</th>
                <td><?= esc($product['capacity']) ?></td>
            </tr>
            <tr>
                <th>Kecepatan Maksimal</th>
                <td><?= esc($product['kapasitas_air_dingin']) ?> Km/Jam</td>
            </tr>
            <tr>
                <th>Jarak Tempuh</th>
                <td><?= esc($product['kapasitas_air_panas']) ?> Km</td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['compressor_warranty'])?> Tahun</td>
            </tr>
            <?php endif; ?>

            <?php if ($product['subcategory'] == 'SETRIKA' || $product['subcategory'] == 'HAIR DRYER'): ?>
            <tr>
                <th>Garansi Elemen Panas</th>
                <td><?= esc($product['garansi_elemen_panas']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Service</th>
                <td><?= esc($product['sparepart_warranty'])?> Tahun</td>
            </tr>

            <?php endif; ?>

            <?php if ($product['subcategory'] == 'TOASTER' || $product['subcategory'] == 'WAFFLE MAKER'): ?>
            <tr>
                <th>Kapasitas</th>
                <td><?= esc($product['capacity']) ?></td>
            </tr>
            <tr>
                <th>Garansi Elemen Panas</th>
                <td><?= esc($product['garansi_elemen_panas']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['sparepart_warranty'])?> Tahun</td>
            </tr>
            <?php endif; ?>

            <?php if ($product['subcategory'] == 'MICROWAVE' ||$product['subcategory'] == 'RICE COOKER' ||$product['subcategory'] == 'MAGIC COM' ||$product['subcategory'] == 'PRESSURE COOKER' ||$product['subcategory'] == 'OVEN FRYER'||$product['subcategory'] == 'CUP SEALER' ||$product['subcategory'] == 'OVEN' ||$product['subcategory'] == 'WATER HEATER' ||$product['subcategory'] == 'WATER BOILER' || $product['subcategory'] == 'COFFEE MAKER'): ?>
            <tr>
                <th>Kapasitas</th>
                <td><?= esc($product['capacity']) ?></td>
            </tr>
            <tr>
                <th>Garansi Elemen Panas</th>
                <td><?= esc($product['garansi_elemen_panas']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Sparepart & Jasa Service</th>
                <td><?= esc($product['sparepart_warranty'])?> Tahun</td>
            </tr>

            <?php endif; ?>

            <?php if ($product['subcategory'] == 'VACUUM CLEANER'): ?>
            <tr>
                <th>Kapasitas</th>
                <td><?= esc($product['capacity']) ?></td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['garansi_semua_service']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Jasa Service</th>
                <td><?= esc($product['sparepart_warranty'])?> Tahun</td>
            </tr>

            <?php endif; ?>

            <?php if ($product['subcategory'] == 'AIR COOLER' || $product['subcategory'] == 'KOMPOR TUNGKU' || $product['subcategory'] == 'KOMPOR TANAM'  || $product['subcategory'] == 'AIR FRYER' || $product['subcategory'] == 'FREE STANDING GAS COOKER' || $product['subcategory'] == 'GRILLER' || $product['subcategory'] == 'KOMPOR GAS OVEN' || $product['subcategory'] == 'KOMPOR LISTRIK'): ?>
            <tr>
                <th>Kapasitas</th>
                <td><?= esc($product['capacity']) ?></td>
            </tr>
            <tr>
                <th>Garansi Jasa Service</th>
                <td><?= esc($product['garansi_semua_service']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['sparepart_warranty'])?> Tahun</td>
            </tr>

            <?php endif; ?>

            <?php if ($product['subcategory'] == 'SMART DOOR LOCK' || $product['subcategory'] == 'SMART LED'): ?>
            <tr>
                <th>Garansi Jasa Service</th>
                <td><?= esc($product['garansi_semua_service']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['sparepart_warranty'])?> Tahun</td>
            </tr>

            <?php endif; ?>

            <?php if ($product['subcategory'] == 'AIR CURTAIN'): ?>
            <tr>
                <th>Ukuran</th>
                <td><?= esc($product['ukuran']) ?></td>
            </tr>
            <tr>
                <th>Garansi Service</th>
                <td><?= esc($product['garansi_semua_service']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['sparepart_warranty'])?> Tahun</td>
            </tr>

            <?php endif; ?>

            <?php if ($product['subcategory'] == 'COOKER HOOD'): ?>
            <tr>
                <th>Ukuran</th>
                <td><?= esc($product['ukuran']) ?></td>
            </tr>
            <tr>
                <th>Garansi Motor</th>
                <td><?= esc($product['garansi_semua_service']) ?> Tahun</td>
            </tr>
            <tr>
                <th>Garansi Sparepart</th>
                <td><?= esc($product['sparepart_warranty'])?> Tahun</td>
            </tr>

            <?php endif; ?>

            <?php if ($product['subcategory'] == 'AIR PURIFIER'): ?>
            <tr>
                <th>Kapasitas</th>
                <td><?= esc($product['kapasitas_air_dingin']) ?> M²</td>
            </tr>
            <tr>
                <th>Garansi Sparepart & Jasa Service</th>
                <td><?= esc($product['garansi_semua_service']) ?> Tahun</td>
            </tr>

            <?php endif; ?>

            <?php if ($product['status'] == 'approved'): ?>
            <tr>
                <th>Tanggal Disetujui</th>
                <td><?= esc($product['approved_at']) ?></td>
            </tr>
            <?php endif; ?>

            <?php if ($product['status'] == 'rejected'): ?>
            <tr>
                <th>Tanggal Ditolak</th>
                <td><?= esc($product['rejected_at']) ?></td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
</section>
<?= $this->endSection() ?>