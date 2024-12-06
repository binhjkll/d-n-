<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <style>
        .table {
            text-align: center;
            margin: auto;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .variant .card {
            border: 1px solid #007bff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .variant .btn-danger {
            margin-top: 10px;
        }
    </style>
</head>

<body>


    <body>
        <!-- Left Panel -->
        <?php require "./views/component/cuthtml.php" ?>


        <!-- /#left-panel -->

        <!-- /#header -->
        <!-- Breadcrumbs-->
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Bảng điều khiển</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="?act=listbook">Bảng điều khiển</a></li>
                                    <li><a href="order-management.html">Sản phẩm</a></li>
                                    <li class="active">Thêm sản phẩm</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nội dung -->
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Thêm sản phẩm mới</strong></div>
                            <div class="card-body card-block">
                                <form method="POST" enctype="multipart/form-data" class="form-horizontal">

                                    <!-- Thông tin sản phẩm chính -->
                                    <div class="form-group">
                                        <label class="form-control-label">Tên sản phẩm</label>
                                        <input type="text" id="name" name="name" required class="form-control" placeholder="Nhập tên sản phẩm">
                                    </div>
                                    <!-- <div class="form-group">
                                            <label class="form-control-label">Tên sản phẩm</label>
                                            <input type="text" id="description" name="description" required class="form-control" placeholder="Nhập tên sản phẩm">
                                        </div> -->
                                    <div class="form-group">
                                        <label class="form-control-label">Mô tả</label>
                                        <textarea name="description" id="description" placeholder="Nhập mô tả sản phẩm" class="form-control" required></textarea>
                                    </div>




                                    <label for="category_id" class="form-control-label">Danh mục:</label>
                                    <select name="category_id" class="form-control">
                                        <?php foreach ($ccc as $value) { ?>

                                            <option value="<?php echo $value->category_id ?>">
                                                <?php echo $value->name ?>
                                            </option>

                                        <?php } ?>
                                    </select>



                                    <div id="variants">
                                        <!-- Mẫu biến thể -->
                                        <div class="variant">
                                            <div class="form-group">
                                                <!-- <label class="form-control-label">Giá sản phẩm</label> -->
                                                <!-- <input type="text" name="price" placeholder="Nhập giá sản phẩm" class="form-control"> -->
                                            </div>
                                            <div class="form-group">
                                                <!-- <label class="form-control-label">Số lượng</label> -->
                                                <!-- <input type="text" name="stock_quantity" placeholder="Nhập số lượng" class="form-control"> -->
                                            </div>
                                            <div class="form-group">
                                                <!-- <label class="form-control-label">Tải lên hình ảnh</label> -->
                                                <!-- <input type="file" name="product_img" class="form-control-file"> -->
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="button" onclick="addVariant()" class="btn btn-primary btn-sm">Thêm biến thể</button>

                                    <button type="submit" name="btn_submit" class="btn btn-primary btn-sm">Lưu sản phẩm</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2024 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
        </div>
        <!-- /#right-panel -->

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="assets/js/main.js"></script>
        <!--  Chart js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
        <script src="assets/js/init/chartjs-init.js"></script>
        <!--Flot Chart-->
        <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>
    </body>

</html>


</body>

</html>
<script>
    document.title = 'Thêm sản phẩm';
    let aa = 1;

    function addVariant() {
        const variants = document.getElementById('variants'); // Lấy phần chứa biến thể

        // Tạo một mã ngẫu nhiên cho mỗi biến thể để tránh xung đột tên
        let r = (Math.random() + 1).toString(36).substring(7);

        // HTML cho mỗi biến thể mới, với các input được gán tên hợp lệ cho mảng


        let html = `
                <div class="card mb-3 variant" id="variant-${r}">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Biến thể ${aa}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-control-label">Giá</label>
                            <input type="text" class="form-control" name="variant[${r}][price]" placeholder="Nhập giá sản phẩm" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Số lượng</label>
                            <input type="text" class="form-control" name="variant[${r}][stock_quantity]" placeholder="Nhập số lượng" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Hình ảnh</label>
                            <input type="file" class="form-control-file" name="variant[${r}][product_img]" required>
                        </div>
                        <button type="button" onclick="removeVariant('variant-${r}')" class="btn btn-danger btn-sm">Xóa biến thể</button>
                    </div>
                </div>
            `;

        // Thêm phần HTML vào phần 'variants'
        variants.innerHTML += html;
        aa++;
    }

    // Hàm để xóa biến thể
    function removeVariant(id) {
        const variant = document.getElementById(id);
        variant.remove();
    }
</script>