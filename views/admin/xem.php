<?php
if (!empty($ccc)) {
    foreach ($ccc as $item) { ?>
        // Xử lý $item
         <tr>
                
            <?php echo "$item->name"?>
            </tr>
 <?php   }
} else {
    echo "Không có dữ liệu để hiển thị.";
}
?>
