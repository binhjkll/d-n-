<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="<?php echo $product['selected_variant']['product_img']; ?>" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <h4 class="fw-bold mb-3" style="color:black"><?php echo htmlspecialchars($product['name']); ?></h4>
                                <p class="mb-3" style="color:black">Danh mục: <?php echo htmlspecialchars($product['category_name']); ?></p>
                                <h5 class="fw-bold mb-3" style="color:black">Giá: <?php echo number_format((float)$product['selected_variant']['price']); ?> VND</h5>
                                <div class="d-flex mb-4">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex flex-wrap mb-3">
                                    <p class="fw-bold me-2">Chọn biến thể:</p>
                                    <?php foreach ($product['variants'] as $variant) { ?>
                                        <a href="index.php?act=productDetail&id=<?php echo $product['product_id']; ?>&variant_id=<?php echo $variant['variant_id']; ?>" 
                                            class="btn btn-outline-primary me-2 <?php echo ($product['selected_variant']['variant_id'] == $variant['variant_id']) ? 'active' : ''; ?>">
                                            Variant <?php echo $variant['variant_id']; ?>
                                        </a>
                                    <?php } ?>
                                </div>
                                <p class="mb-4" style="color:black">Số lượng trong kho: <?php echo htmlspecialchars($product['selected_variant']['stock_quantity']); ?></p>
                                <!-- <p class="mb-4" style="color:black">Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish</p> -->
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php
                                // Kiểm tra người dùng đã đăng nhập hay chưa
                                $isLoggedIn = isset($_SESSION['username']);
                                ?>

                                <a href="index.php?act=addToCart&id=<?php echo $product['product_id']; ?>&quantity=1&variant_id=<?php echo $product['selected_variant']['variant_id']; ?>" 
                                    class="btn border border-secondary rounded-pill px-3 text-primary"
                                    onclick="<?php if (!$isLoggedIn) { echo 'alert(\'Bạn cần đăng nhập để mua sản phẩm này.\'); location.href=\'index.php?act=login\'; return false;'; } ?>">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                </a>
                                <a href="index.php?act=addToCart&id=<?php echo $product['product_id']; ?>&quantity=1&variant_id=<?php echo $product['selected_variant']['variant_id']; ?>&redirect=cart" 
                                    class="btn btn-primary rounded-pill px-3 text-white"
                                    onclick="<?php if (!$isLoggedIn) { echo 'alert(\'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.\'); location.href=\'index.php?act=login\'; return false;'; } ?>">
                                    Buy Now
                                </a>
                            </div>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">Description</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <p style="color:black"><?php echo htmlspecialchars($product['description']); ?>  </p>
                                    </div>
                                </div>
                            </div>