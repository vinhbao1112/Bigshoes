<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../bigshoes/css/chi-tiet-sp/products.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../bigshoes/css/chi-tiet-sp/plugin/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../bigshoes/css/chi-tiet-sp/plugin/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="../css/trang-chinh/img/TBT.png">
    <link rel="shortcut icon" type="image/png" href="../css/trang-chu/img/TBT.png" />
    <title>Chi tiết đơn mua</title>
</head>

<body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../../bigshoes/css/chi-tiet-sp/plugin/js/owl.carousel.min.js"></script>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" style="background-color: rgb(54, 54, 54);text-align: center">
                <div class="login">
                    <?php
                    session_start();
                    if (!isset($_SESSION['user'])) {
                    ?>
                        <a href="../../bigshoes/tai-khoan/dang-nhap.php">
                            <p><strong>ĐĂNG NHẬP / ĐĂNG KÍ</strong></p>
                        </a>
                    <?php } else { ?>
                        <a href="../../bigshoes/tai-khoan/thong-tin-tk.php">
                            <p><strong>XIN CHÀO <?= $_SESSION['user']['ho_ten'] ?></strong></p>
                        </a>
                    <?php } ?>
                </div>



            </div>
            <div class="col-md-4" style="background-color: rgb(54, 54, 54);text-align: center">
                <div class="logo">
                    <a href="index.php"><img src="../css/danh-sach-sp/img/TBT.png" alt="anh"></a>
                </div>
            </div>
            <div class="col-md-4" style="background-color: rgb(54, 54, 54);text-align: center">

                <div class="giohang" style="position: reletive;">

                    <?php
                    $sll = 0;
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            extract($item);
                            $sll += $sl;
                        }
                    }
                    ?>
                    <span style="position: absolute;padding:3px 8px;background-color:#fff;border-radius:50px;left:295px;top:25px;"><?= $sll ?></span>
                    <ul>
                        <li style="list-style: none;">
                            <p style="font-size: 14px;">
                                <a href="don-mua.php" style="text-decoration:none;color:#f7941d;">ĐƠN MUA</a>
                            </p>
                        </li>
                        <li style="list-style: none;">
                            <p style="color: rgb(212, 212, 212);font-size: 14px;">GIỎ HÀNG</p>
                        </li>
                        <a href="danh-sach-gio-hang.php">
                            <li style="list-style: none;">
                                <i class="fa fa-shopping-basket" style="font-size:28px;color:rgb(255, 255, 255)"></i>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="background-color: rgb(211, 211, 211);">
                <div class="nav">
                    <ul>
                        <li><a href="index.php">TRANG CHỦ</a></li>
                        <li><a href="danh-sach-sp.php">SẢN PHẨM</a></li>
                        <li><a href="gioi-thieu.php">GIỚI THIỆU</a></li>
                        <li><a href="bao-hanh.php">BẢO HÀNH</a></li>
                        <li><a href="lien-he.php">LIÊN HỆ</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div id="page-wrapper">
        <div class="header">
            <?php
            if (isset($_SESSION['user'])) {
                $conn = mysqli_connect('localhost', 'root', '', 'bigshoes');
                $username = $_SESSION['user'];
                $Total = 0;
                $result1 = mysqli_query($conn, "SELECT * FROM hoa_don_chi_tiet WHERE ma_hd = '" . $_GET['ma_hd'] . "'");
            ?>

                <div class="page-header">
                    <p style="font-size: 24px"><b>Dưới đây là những sản phẩm mà khách hàng đã mua: </b></p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>TÊN HÀNG HÓA</th>
                                <th>SỐ LƯỢNG</th>
                                <th>ĐƠN GIÁ/SP</th>
                                <th>THÀNH TIỀN</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($result1)) {
                                foreach ($result1 as $item) {
                                    extract($item);
                                    $result2 = mysqli_query($conn, "SELECT * FROM hang_hoa WHERE ma_hh ='" . $item['ma_hh'] . "'");
                                    $detail = mysqli_fetch_assoc($result2);
                            ?>
                                    <tr>
                                        <td><b><?= $detail['ten_hh'] ?></b></td>
                                        <td><?= $so_luong ?></td>
                                        <td><?= number_format($detail['don_gia']) ?> <sup>đ</sup></td>
                                        <td><b><?= number_format($detail['don_gia'] * $so_luong);
                                                $Total += ($detail['don_gia'] * $so_luong) ?> <sup>đ</sup></b></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3" style="text-align:center;background:#B6DDDA"><b>TỔNG TIỀN</b></td>
                                    <td style="background: #01877   E;"><b><?= number_format($Total) ?> <sup>đ</sup></b></td>
                                </tr>
                        </tbody>

                    </table>
                </div>
        <?php }
                        } ?>
        </div>
    </div>
    <script src="../../css/admin/js/jquery-1.10.2.js"></script>
    <script src="../../css/admin/js/bootstrap.min.js"></script>
    <script src="../../css/admin/js/jquery.metisMenu.js"></script>
    <script src="../../css/admin/js/custom-scripts.js"></script>
</body>

</html>