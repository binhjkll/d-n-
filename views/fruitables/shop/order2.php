 <?php
    require "inc/header.php";

    ?>

 <form action="" method="post">
     <img src="<?php echo $bb['product_img']; ?>" alt="" width="50">
     <input type="text" name="total_amount" placeholder="total_amount" value="<?php echo $bb['price'] * $cc['quantity']; ?>">
     <input type="hidden" name="delivery_status" placeholder="delivery_status" value="Đang chuẩn bị">
     <input type="text" name="variant_id" placeholder="variant_id" value="<?php echo $bb['variant_id'] ?>">
     <input type="text" name="quantity" placeholder="quantity" value="<?php echo $cc['quantity'] ?>">
     <input type="text" name="price" placeholder="price" value="<?php echo $bb['price'] ?>">

     <br>

     <input type="text" name="phone" value="<?php echo $phone ?>">
     <input type="text" name="address" value="<?php echo $address ?>">
     <input type="radio" name="payment_status" value="thanh toán khi nhận hàng">
     <label for="">thanh toán khi nhận hàng</label>
     <input type="radio" name="payment_status" value="thanh toán trực tiếp">
     <label for="">thanh toán trực tiếp</label>
     <a href="?act=removeFromCart">
         <button name="btn_submit">gui</button>
     </a>
 </form>