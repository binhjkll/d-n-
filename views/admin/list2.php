<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <a href="?act=add"><button>them</button></a> -->
    <a href="?act=register"><button>dangky</button></a>
    <a href="?act=login"><button>login</button></a>
    <a href="?act=binh"><button>them</button></a>
    <a href="?act=xem"><button>xem</button></a>
    <table border="1">
        <tr>
            <td>product_id</td>
            <td>name</td>
            <td>description</td>
            <td>category_name</td>
            <td>variant_id</td>
            <td>price</td>
            <td>stock_quantity</td>
            <td>product_img</td>
            <td>action</td>
        </tr>
        <?php foreach ($listbook as $value) { ?>
            <tr>
                <td><?php echo $value->product_id; ?></td>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->description; ?></td>
                <td><?php echo $value->category_name; ?></td>
                <td><?php echo $value->variant_id; ?></td>
                <td><?php echo $value->price; ?></td>
                <td><?php echo $value->stock_quantity; ?></td>
                <td><img src="<?php echo $value->product_img; ?>" alt="Product Image" width="100px"></td>
                <td>
                    <a href="?act=edit&id=<?php echo $value->product_id; ?>&vid=<?php echo $value->variant_id; ?>"><button>Sửa</button></a>
                    <button onclick="confirmDeleteBook('?act=delete&id=<?php echo $value->product_id; ?>&vid=<?php echo $value->variant_id; ?>')">Xóa</button>
                </td>
            </tr>
        <?php } ?>
    </table>


</body>
<script>
    function confirmDeleteBook(deleUrl) {
        if (confirm('Are you sure you want to delete')) {
            document.location = deleUrl;
        }
    }
</script>


</html>


