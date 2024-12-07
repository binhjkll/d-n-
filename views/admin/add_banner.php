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






    <?php require "./views/component/cuthtml.php" ?>

  
    <div class="container mt-4">
    <!-- Breadcrumbs -->
    <div class="card shadow-sm mb-4">
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0 text-primary">Bảng điều khiển</h5>
                </div>
                <div class="col-md-6 text-right">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item"><a href="index.php?page_layout=danhmuc" class="text-decoration-none">Banner</a></li>
                        <li class="breadcrumb-item active">Thêm Banner</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Nội dung Form -->
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Thêm Banner Mới</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
                <!-- Tên Banner -->
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Tên Banner:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên banner">
                </div>
                <!-- Đường Dẫn -->
                <div class="form-group">
                    <label for="link" class="font-weight-bold">Đường Dẫn (URL):</label>
                    <input type="text" class="form-control" id="link" name="link" placeholder="Nhập đường dẫn">
                </div>
                <!-- Hình Ảnh -->
                <div class="form-group">
                    <label for="image" class="font-weight-bold">Hình Ảnh:</label>
                    <input type="file" class="form-control-file border p-2" id="image" name="image" accept="image/*">
                </div>
                <!-- Hiển Thị -->
                
                <!-- Nút Submit -->
                <button type="submit" name="btn_submit" class="btn btn-success btn-block">Thêm Banner</button>
            </form>
        </div>
    </div>
</div>






    
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
