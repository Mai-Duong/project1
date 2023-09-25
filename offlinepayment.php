<?php
include 'inc/header.php';
?>

<?php
// if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
//     $customer_id = Session::get('customer_id');
//     $insertOrder = $ct->insertOrder($customer_id);
//     $delCart = $ct->del_all_data_cart();
//     header('Location:success.php');
// } 
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
//     $quantity_cart = $_POST['quantity_cart'];
//     $AddtoCart = $ct->add_to_cart($quantity_cart, $id);
// }

if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $check_customer_id = $ct->checkCustomerExistence($customer_id);

    if ($check_customer_id) {
        $insertOrder = $ct->insertOrder($customer_id);
        $delCart = $ct->del_all_data_cart();
        header('Location: success.php');
    } else {
        $alert = '<span>Chưa có tài khoản. Đăng nhập để mua hàng.</span>';
        echo '<script>alert("' . $alert . '");</script>';
        // Bạn có thể chuyển hướng người dùng đến trang đăng nhập hoặc hiển thị thông báo lỗi tại đây.
        // Ví dụ: header('Location: login.php') hoặc echo $alert;
    }
}


?>
<style type="text/css">
    .box_left {
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }

    .box_right {
        width: 46%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }
</style>

<form action="" method="">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Thanh toán khi nhận hàng</h3>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                        <h2>Giỏ hàng của bạn</h2>
                        <?php
                        if (isset($update_quantity_cart)) {
                            echo $update_quantity_cart;
                        }
                        ?>
                        <?php
                        if (isset($delcart)) {
                            echo $delcart;
                        }
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Tên sản phẩm</th>
                                <th width="10%">Hình ảnh</th>
                                <th width="15%">Giá</th>
                                <th width="25%">Số lượng</th>
                                <th width="20%">Thành tiền</th>
                            </tr>

                            <?php
                            $get_product_cart = $ct->get_product_cart();
                            if ($get_product_cart) {
                                $totalpro = 0;
                                $total = 0;
                                $i = 0;
                                while ($result = $get_product_cart->fetch_assoc()) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td>
                                            <?php echo $result['productName'] ?>
                                        </td>
                                        <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
                                        <td>
                                            <?php echo $result['price'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result['quantity_cart'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $total = $result['price'] * $result['quantity_cart'];
                                            echo $total;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $totalpro += $total;
                                }
                            }
                            ?>

                        </table>
                        <table style="float:right;text-align:left;" width="40%">
                            <tr>
                                <th>Tổng tiền : </th>
                                <td>
                                    <?php
                                    echo $totalpro;
                                    Session::set('sum', $totalpro);
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box_right">
                    <table class="tblone">
                        <?php
                        $id = Session::get('customer_id');
                        $get_customers = $cs->customer_shows($id);
                        if ($get_customers) {
                            while ($result = $get_customers->fetch_assoc()) {

                                ?>
                                <tr>
                                    <td>Họ tên</td>
                                    <td> : </td>
                                    <td>
                                        <?php echo $result['name'] ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Thành phố</td>
                                    <td> : </td>
                                    <td>
                                        <?php echo $result['city'] ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Điện thoại</td>
                                    <td> : </td>
                                    <td>
                                        <?php echo $result['phone'] ?>
                                    </td>
                                </tr>




                                <tr>
                                    <td>Mail</td>
                                    <td> : </td>
                                    <td>
                                        <?php echo $result['email'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td> : </td>
                                    <td>
                                        <?php echo $result['address'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <a href="editprofile.php">Sửa</a>
                                    </td>
                                </tr>
                                <?php

                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <style>
            .center-container {
                display: flex;
                justify-content: center;
                /* Căn giữa theo chiều ngang */
                align-items: center;
                /* Căn giữa theo chiều dọc */
                /* height: 100vh; */
                /* 100% chiều cao của viewport (màn hình) */
            }

            /* Định dạng nút submit */
            .submit-button {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                cursor: pointer;
                border-radius: 5px;
                align-items: center;
                margin-bottom: 10px;
            }

            .submit-button:hover {
                background-color: #45a049;
            }
        </style>
        <div class="center-container">
            <a class="submit-button" href="?orderid=order">Order Now</a>

        </div>
    </div>
</form>
<?php
include 'inc/footer.php';
?>