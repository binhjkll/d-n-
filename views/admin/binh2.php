<form method="POST" enctype="multipart/form-data">
    <h2>Thêm Sản Phẩm</h2>

    <!-- Thông tin sản phẩm chính -->
    <input type="text" id="name" name="name" required>

    <input type="text" id="description" name="description" required>

    <br>

    <label for="category_id">Danh mục:</label>
    <select name="category_id">
        <?php foreach ($ccc as $value) { ?>

            <option value="<?php echo $value->category_id ?>">
                <?php echo $value->name ?>
            </option>

        <?php } ?>
    </select>
    <h3>Biến thể sản phẩm</h3>

    <div id="variants">
        <!-- Mẫu biến thể -->
        <div class="variant">
            <input type="text" name="price" placeholder="gia">
            <input type="text" name="stock_quantity" placeholder="stock_quantity">
            <input type="file" name="product_img">
        </div>
    </div>

    <button type="button" onclick="addVariant()">Thêm biến thể</button>

    <button type="submit" name="btn_submit">Lưu sản phẩm</button>

</form>

<script>
    function addVariant() {
        const variants = document.getElementById('variants'); // Lấy phần chứa biến thể

        // Tạo một mã ngẫu nhiên cho mỗi biến thể để tránh xung đột tên
        let r = (Math.random() + 1).toString(36).substring(7);

        // HTML cho mỗi biến thể mới, với các input được gán tên hợp lệ cho mảng
        let html = `
            <div class="variant" id="variant-${r}">
                <input type="text" name="variant[${r}][price]" placeholder="Giá" required>
                <input type="text" name="variant[${r}][stock_quantity]" placeholder="Số lượng" required>
                <input type="file" name="variant[${r}][product_img]" placeholder="Ảnh sản phẩm" required>
                <button type="button" onclick="removeVariant('variant-${r}')">Xóa biến thể</button>
            </div>
        `;

        // Thêm phần HTML vào phần 'variants'
        variants.innerHTML += html;
    }

    // Hàm để xóa biến thể
    function removeVariant(id) {
        const variant = document.getElementById(id);
        variant.remove();
    }
</script>