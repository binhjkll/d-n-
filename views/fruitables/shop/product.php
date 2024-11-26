<?php
$displayedProducts = []; 

foreach ($listpro as $value) {
    if (in_array($value->product_id, $displayedProducts)) {
        continue; 
    }

    $displayedProducts[] = $value->product_id; 
?>
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="rounded position-relative fruite-item">
            <div class="fruite-img">
                <a href="index.php?act=productDetail&id=<?php echo $value->product_id; ?>&variant_id=<?php echo $value->variant_id; ?>">
                    <img src="<?php echo $value->product_img; ?>" class="img-fluid w-100 rounded-top" alt="">
                </a>
            </div>
            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                <?php echo $value->category_name; ?>
            </div>
            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                <a href="index.php?act=productDetail&id=<?php echo $value->product_id; ?>&variant_id=<?php echo $value->variant_id; ?>">
                    <h4><?php echo $value->name; ?></h4>
                </a>
                <div class="d-flex justify-content-between flex-lg-wrap">
                    <p class="text-dark fs-5 fw-bold mb-0"><?php echo number_format($value->price); ?> VND</p>
                    <a href="index.php?act=productDetail&id=<?php echo $value->product_id; ?>&variant_id=<?php echo $value->variant_id; ?>"
                        class="btn border border-secondary rounded-pill px-3 text-primary">
                        Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>