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

        .aa {
            border: none;
            background-color: white;
            height: 30px;

        }

        .bb {
            color: blue;
        }
    </style>
</head>

<body>

    <!doctype html>

    <html class="no-js" lang="">




    <body>
        <?php require "./views/component/cuthtml.php" ?>

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
                                    <li><a href="#"></a>Sản phẩm</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bảng hiển thị sản phẩm -->
        <div class="content mt-3">
            <div class="container-fluid">
                <div class="table-responsive">

                    <!-- Nút thêm mới sản phẩm -->
                    <a href="?act=binh">
                        <button class="btn btn-primary btn-sm mb-3">Thêm mới sản phẩm</button>
                    </a>

                    <!-- Bảng sản phẩm -->
                    <table class="table table-bordered table-hover table-striped table-sm">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>product_id</th>
                                <th>name</th>
                                <th>description</th>
                                <th>category_name</th>
                                <th>variant_id</th>
                                <th>price</th>
                                <th>stock_quantity</th>
                                <th>product_img</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listbook as $value) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $value->product_id; ?></td>
                                    <td><?php echo $value->name; ?></td>
                                    <td><?php echo $value->description; ?></td>
                                    <td><?php echo $value->category_name; ?></td>
                                    <td class="text-center"><?php echo $value->variant_id; ?></td>
                                    <td><?php echo $value->price; ?></td>
                                    <td class="text-center"><?php echo $value->stock_quantity; ?></td>
                                    <td class="text-center">
                                        <img src="<?php echo $value->product_img; ?>" alt="Product Image" class="img-fluid" width="80">
                                    </td>
                                    <td class="text-center">
                                        <a href="?act=edit&id=<?php echo $value->product_id; ?>&vid=<?php echo $value->variant_id; ?>">
                                            <button class="btn btn-success btn-sm">Sửa</button>
                                        </a>
                                        <button onclick="confirmDeleteBook('?act=delete&id=<?php echo $value->product_id; ?>&vid=<?php echo $value->variant_id; ?>')" class="btn btn-danger btn-sm">Xóa</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

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
    function confirmDeleteBook(deleUrl) {
        if (confirm('Are you sure you want to delete')) {
            document.location = deleUrl;
        }
    }
    document.title = 'Admin';
</script>