<form method="POST" enctype="multipart/form-data">
    <h2>Sửa Sản Phẩm</h2>

    <!-- Thông tin sản phẩm chính -->
    <label class="form-control-label">Tên sản phẩm</label>
    <input type="text" id="name" name="name" required value="<?php echo $idBook['name'] ?>" class="form-control">
    <label class="form-control-label">Mô tả</label>
    <input type="text" id="description" name="description" required value="<?php echo $idBook['description'] ?>" class="form-control">

    <br>

    <label for="category_id" class="form-control-label">Danh mục:</label>
    <select name="category_id">
        <?php foreach ($ccc as $value) { ?>
            <option value="<?php echo $value->category_id ?>">
                <?php echo $value->name ?>
            </option>
        <?php } ?>
    </select>

    <div id="variants">
        <!-- Mẫu biến thể -->
        <div class="variant">
            <label class="form-control-label">Giá</label> <br>

            <input type="text" name="price" placeholder="Giá" value="<?php echo $iddBook['price'] ?>">
            <label class="form-control-label">Số lượng</label><br>

            <input type="text" name="stock_quantity" placeholder="Số lượng tồn kho" value="<?php echo $iddBook['stock_quantity'] ?>">
            <input type="file" name="product_img">
            <img src="<?php echo $iddBook['product_img'] ?>" alt="" width="100px">
        </div>
    </div>


    <button type="submit" name="btn_submit" class="btn btn-primary btn-sm">Lưu sản phẩm</button>

</form>