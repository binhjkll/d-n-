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
                                    <li><a href="?act=quanlyorder">Quản lý đơn hàng</a></li>
                                    <li class="active">Chi tiết đơn hàng</li>
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
                            <div class="card-body card-block">



                                <?php foreach ($la as $aa) { ?>

                                    <?php if ($aa->delivery_status == 'Đã huỷ'): ?>
                                        <table class="table table-bordered text-center rounded"
                                            style="border-collapse: collapse; margin: 20px 0; width: 20%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                            <thead style="background-color: #f1f1f1;">
                                                <tr>
                                                    <th style="padding: 8px; font-size: 18px; font-weight: bold; color: red; text-align: left;">
                                                        Lý do huỷ
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 15px; font-size: 16px; color: #555; text-align: left;">
                                                        <?php
                                                        echo $aa->cancel_reason;

                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    <?php endif; ?>

                                <?php } ?>
                                <form action="" method="post">
                                    <table class="table table-striped table-bordered text-center rounded" style="overflow: hidden;">
                                        <thead class="thead-dark" style="background-color: #f8f9fa; color: #333; border-radius: 12px;">
                                            <tr>
                                                <th class="text-center" style="width: 15%; font-weight: bold;">Order Item ID</th>
                                                <th class="text-center" style="width: 15%; font-weight: bold;">Quantity</th>
                                                <th class="text-center" style="width: 15%; font-weight: bold;">Price</th>
                                                <th class="text-center" style="width: 15%; font-weight: bold;">Total Price</th>
                                                <th class="text-center" style="width: 10%; font-weight: bold;">Size</th>
                                                <th class="text-center" style="width: 20%; font-weight: bold;">Image</th>

                                            </tr>
                                        </thead>

                                        <tbody>


                                            <?php if (!empty($listbook)): ?>
                                                <?php foreach ($listbook as $item): ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?php echo $item->order_item_id; ?></td>
                                                        <td class="text-center align-middle"><?php echo $item->quantity; ?></td>
                                                        <td class="text-center align-middle">$<?php echo number_format($item->order_item_price, 2); ?></td>
                                                        <td class="text-center align-middle">$<?php echo number_format($item->total_item_price, 2); ?></td>
                                                        <td class="text-center align-middle"><?php echo $item->size; ?></td>
                                                        <td class="text-center align-middle">
                                                            <img src="<?php echo $item->product_img; ?>" alt="Product Image" style="width: 50px; height: 50px; border-radius: 8px; border: 1px solid #ccc;">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td class="text-center align-middle" colspan="6">No items found for this order.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>

                                    </table>
                                    <br>



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