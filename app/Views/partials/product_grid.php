<style>
    /* General box-sizing for all elements */
    * {
    box-sizing: border-box;
}

/* Product grid container */
#productGrid {
    width: 100%;
    padding: 0 27px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* Space between cards */
}

.picture-container {
    background-color:#f4f4f4;
    height:169px;
    width:100%;
    border-bottom: 2px solid #F4F4F4;
}
/* Define each product item with fixed width and spacing */
.product-item {
    flex: 0 0 33.33%; /* 3 items per row */
    width: 33.33%; /* Prevent resizing */
    margin-bottom: 35px; /* Space between rows */
    padding: 0 22.5px; /* Space between columns */
    position: relative;
    height: 300px; /* Fixed height for consistent appearance */
    width: 295px; /* Prevent shrinking */
}

    /* Ensure product images are responsive and maintain aspect ratio */
    .product-item img {
        width: 100%;
        height: 169px;
        background-color:#f4f4f4;
        object-fit: cover;
    }

/* Grid card to ensure height consistency */
.grid-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    border: 2px solid #F4F4F4;
}

.product-placeholder {
    flex: 0 0 33.33%; /* Match the width of product-item */
    max-width: 33.33%; /* Prevent resizing */
    height: 280px; /* Match height of product-item */
    padding: 0 10px;
    margin-bottom: 15px;
    visibility: hidden; /* Hidden but occupies space */
}

    .card-body {
        display: flex;
        width:247px;
        flex-direction: column;
        padding: 15px;
        padding-top:5px;
        padding-left:10px;
        overflow: hidden; /* To prevent overflow */
    }

    .card-title {
        font-size: 12px; /* Adjusted for better readability */
        font-weight: 800;
        margin-bottom: 3px; /* Increase spacing */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-text {
        font-size: 12px;
        margin-bottom:3px;
        color: #222;
        margin: 0; /* Add some margin for better spacing */
    }

    .card-subtext {
        font-size: 12px;
        margin-bottom:3px;
        color: #666;
        margin: 0; /* Add some margin for better spacing */
    }

    /* Adjust the button styling */
/* Button positioned bottom-right */
.button {
    position: absolute;
    bottom: 19px;
    right:30px;  /* Ensure button is in the bottom-right */
    width:75px;
    height:19px;
    text-align:center;
    font-size: 12px;
    background-color: #fff;
    color: #000;
    font-size:11px;
    border: 1px solid #000;
    border-radius: 4px;
    cursor: pointer;
    text-align: left;
    z-index: 1;  /* Keep button on top if necessary */
}

    /* Ensure checkbox and label styling */
    .compare-checkbox {
    position: absolute;
    bottom: 19px; /* Position the checkbox towards the bottom */
    left: 35px;   /* Position the checkbox towards the left */
    display:none;
}


    .compare-label {
        margin-left: 17px;
        bottom:8px;
        vertical-align: middle;
        font-size: 14px;
        color: #000;
        display:none;
        position:absolute;
    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
        .product-item {
            flex: 1 0 48%; /* 2 items per row on smaller screens */
            max-width: 48%;
        }
    }

    @media (max-width: 480px) {
        .product-item {
            flex: 1 0 98%; /* 1 item per row on mobile screens */
            max-width: 98%;
        }
    }
</style>

<!-- Product Grid -->
<div id="productGrid">
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <div class="grid-card">
                        <div class="picture-container">
<!-- untuk sementara, dianggap sama kalau gaada subkategori lain-->
<?php if ($product['category'] == "AC" || $product['subcategory'] == "AIR CURTAIN"): ?>
<img style="margin: 40px auto; display: block; width: 95%; height: 86px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['category'] == "TV" || $product['subcategory'] == "MOTOR LISTRIK"): ?>
    <img style="margin: 17px auto; display: block; width: 95%; height: 133px; object-fit: contain;" 
         src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" 
         class="card-img-top" 
         alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['category'] == "KULKAS"): ?>
<img style="margin: 16px auto; display: block; width: 95%; height: 148px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['category'] == "MESIN CUCI" && $product['subcategory'] == "2 TABUNG" ): ?>
<img style="margin: 22px auto; display: block; width: 95%; height: 140px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['category'] == "MESIN CUCI"): ?>
<img style="margin: 22px auto; display: block; width: 95%; height: 137px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['category'] == "FREEZER" && $product['subcategory'] == "CHEST FREEZER 2 PINTU" ): ?>
<img style="margin: 34px auto; display: block; width: 95%; height: 114px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['category'] == "FREEZER" || $product['subcategory'] == "KOMPOR GAS OVEN" || $product['subcategory'] == "FREE STANDING GAS COOKER"): ?>
<img style="margin: 19px auto; display: block; width: 95%; height: 137px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['category'] == "SHOWCASE" && $product['subcategory'] == "SHOWCASE 1 PINTU" ): ?>
<img style="margin: 15px auto; display: block; width: 95%; height: 141px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['category'] == "SHOWCASE" && $product['subcategory'] == "SHOWCASE 2 PINTU" || $product['subcategory'] == "SHOWCASE 2 PINTU ATAU LEBIH" ): ?>
<img style="margin: 15px auto; display: block; width: 95%; height: 141px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['category'] == "SHOWCASE" && $product['subcategory'] == "SHOWCASE CAKE" ): ?>
<img style="margin: 34px auto; display: block; width: 95%; height: 114px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "AIR FRYER" || $product['subcategory'] == "COFFEE MAKER" || $product['subcategory'] == "MIXER" || $product['subcategory'] == "WATER BOILER"): ?>
<img style="margin: 22px auto; display: block; width: 95%; height: 131px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "KIPAS ANGIN" || $product['subcategory'] == "SMART LED"): ?>
<img style="margin: 17px auto; display: block; width: 95%; height: 155px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "RICE COOKER" || $product['subcategory'] == "MAGIC COM" || $product['subcategory'] == "PRESSURE COOKER"): ?>
<img style="margin: 17px auto; display: block; width: 95%; height: 138px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "WATER HEATER" || $product['subcategory'] == "TOASTER"): ?>
<img style="margin: 30px auto; display: block; width: 95%; height: 113px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "DISPENSER GALON BAWAH" || $product['subcategory'] == "DISPENSER GALON ATAS"): ?>
<img style="margin: 9px auto; display: block; width: 95%; height: 154px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "SPEAKER" || $product['subcategory'] == "CUP SEALER"): ?>
<img style="margin: 15px auto; display: block; width: 95%; height: 145px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "MICROWAVE" || $product['subcategory'] == "OVEN" || $product['subcategory'] == "OVEN FRYER"): ?>
<img style="margin: 33px auto; display: block; width: 95%; height: 113px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "KOMPOR LISTRIK" || $product['subcategory'] == "KOMPOR TUNGKU" ||$product['subcategory'] == "KOMPOR TANAM"): ?>
<img style="margin: 30px auto; display: block; width: 95%; height: 115px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "AIR PURIFIER" || $product['subcategory'] == "AIR COOLER" || $product['subcategory'] == "COOKER HOOD"): ?>
<img style="margin: 14px auto; display: block; width: 95%; height: 138px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "VACUUM CLEANER"): ?>
<img style="margin: 7px auto; display: block; width: 95%; height: 157px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "SETRIKA" || $product['subcategory'] == "GRILLER" || $product['subcategory'] == "WAFFLE MAKER"): ?>
<img style="margin: 20px auto; display: block; width: 95%; height: 123px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "BLENDER" || $product['subcategory'] == "JUICER" || $product['subcategory'] == "CHOPPER"): ?>
<img style="margin: 30px auto; display: block; width: 95%; height: 113px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "HAIR DRYER" || $product['subcategory'] == "HAND MIXER"): ?>
<img style="margin: 20px auto; display: block; width: 95%; height: 123px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php elseif ($product['subcategory'] == "SMART DOOR LOCK"): ?>
<img style="margin: 17px auto; display: block; width: 95%; height: 137px; object-fit: contain;" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<!-- belum di set -->
<?php else: ?>
<img style="width:80%; height:80%; margin: 10px 20px" src="<?= base_url('uploads/'. esc($product['gambar_depan'])) ?>" class="card-img-top" alt="<?= esc($product['product_type']) ?>">
<?php endif; ?>

                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($product['brand']) ?></h5>
                            <p class="card-text"><?= esc($product['category']) ?> <?= esc($product['subcategory']) ?>                                 <?php
                                if (!empty($product['capacity'])) {
                                    echo esc($product['capacity']);
                                } elseif (!empty($product['ukuran'])) {
                                    echo esc($product['ukuran']);
                                } elseif (!empty($product['kapasitas_air_dingin'] && $product['kapasitas_air_panas'])) {
                                    echo esc($product['kapasitas_air_dingin'] . 'L' . '/' . $product['kapasitas_air_panas'] . 'L');
                                } elseif ($product['subcategory'] == 'AIR PURIFIER') {
                                    echo esc($product['kapasitas_air_dingin'] . ' M²');
                                } else {
                                    echo '';
                                }
                                ?></p>
                            <p class="card-subtext"> <?= esc($product['product_type']) ?></p>
                            <div class="column">
<input type="checkbox" class="compare-checkbox" data-product-id="<?= esc($product['id']) ?>"
           data-product-name="<?= esc($product['brand']) ?>"
           data-product-category="<?= esc($product['category']) ?>"
           data-product-subcategory="<?= esc($product['subcategory']) ?>"
           data-product-capacity="<?php
    if (!empty($product['capacity'])) {
        echo esc($product['capacity']);
    } elseif (!empty($product['ukuran'])) {
        echo esc($product['ukuran']);
    } elseif (!empty($product['kapasitas_air_dingin'] && $product['kapasitas_air_panas'])){
        echo esc($product['kapasitas_air_dingin']. 'L' . '/' . $product['kapasitas_air_panas'] . 'L');
    } elseif ($product['subcategory'] == 'AIR PURIFIER'){
        echo esc($product['kapasitas_air_dingin']. 'M²');
    } else {
        echo ' ';
    }
    ?> | <?= esc($product['product_type']) ?>"
           data-product-image="<?= base_url('uploads/' . esc($product['gambar_depan'])) ?>">
    <label class="compare-label" style="font-size:14px">Bandingkan</label>
<button class="button" onclick="location.href='/catalog/details/<?= esc($product['id']) ?>'">Lihat Detail</button>
</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Add placeholders to maintain grid alignment -->
            <?php for ($i = count($products); $i < 3; $i++): ?>
                <div class="product-placeholder"></div>
            <?php endfor; ?>
        <?php else: ?>
            <p>Tidak ada produk pada filter ini.</p>
        <?php endif; ?>
    </div>
</div>


