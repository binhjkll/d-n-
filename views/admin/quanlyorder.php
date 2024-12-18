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
                                    <li class="active">Quản lý đơn hàng</li>
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

                                <form action="" method="post">
                                    <table class="table table-bordered table-hover table-striped table-sm">
                                        <thead class="thead-dark text-center">
                                            <tr>
                                                <th>order_id </th>
                                                <th>user_id </th>
                                                <th>total_amount</th>
                                                <th>payment_status</th>
                                                <th>delivery_status</th>
                                                <th>created_at</th>
                                                <th>address</th>
                                                <th>phone</th>
                                                <th>email</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listbook as $value) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $value->order_id; ?></td>
                                                    <td class="text-center"><?php echo $value->user_id; ?></td>
                                                    <td>$<?php echo $value->total_amount; ?></td>
                                                    <td><?php echo $value->payment_status; ?></td>
                                                    <td>
                                                        <form method="POST">
                                                            <select name="delivery_status" onchange="this.form.submit()"
                                                                <?php echo ($value->delivery_status == 'Đã huỷ' || $value->delivery_status == 'Đã giao') ? 'disabled' : ''; ?>>
                                                                <option value="Đã huỷ" <?php echo $value->delivery_status == 'Đã huỷ' ? 'selected' : ''; ?>>Đã huỷ</option>
                                                                <option value="Đang chuẩn bị" <?php echo $value->delivery_status == 'Đang chuẩn bị' ? 'selected' : ''; ?>>Đang chuẩn bị</option>
                                                                <option value="Đang giao" <?php echo $value->delivery_status == 'Đang giao' ? 'selected' : ''; ?>>Đang giao</option>
                                                                <option value="Đã giao" <?php echo $value->delivery_status == 'Đã giao' ? 'selected' : ''; ?>>Đã giao</option>
                                                            </select>
                                                            <input type="hidden" name="order_id" value="<?php echo $value->order_id; ?>">
                                                        </form>



                                                    </td>
                                                    <td class="text-center"><?php echo $value->created_at; ?></td>
                                                    <td><?php echo $value->address; ?></td>
                                                    <td class="text-center"><?php echo $value->phone; ?></td>
                                                    <td class="text-center"><?php echo $value->email; ?></td>
                                                    <td class="text-center align-middle">
                                                        <a href="?act=chitietorder&pid=<?php echo $value->order_id; ?>" class="btn btn-dark btn-sm">Xem chi tiết</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>

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