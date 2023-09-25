<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>

<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}else{
    header('Location:index.php');
}

$ct = new cart();
if (isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'];
    $shirfed_cormfim = $ct->shirfed_cormfim($id);
}



?>


<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2 style="width:500px ;">Thông tin chi tiết của bạn Đã đặt hàng</h2>
                <table class="tblone">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Tên sản phẩm</th>
                        <th width="10%">Ảnh</th>
                        <th width="15%">Giá</th>
                        <th width="10%">Số lượng</th>
                        <th width="20%">Ngày đặt</th>
                        <th width="10%">Trạng thái</th>
                        <th width="10%">Hoạt động</th>
                    </tr>
                    <?php
                    $customer_id = Session::get('customer_id');
                    $get_cart_order_of_customer = $ct->get_cart_order_of_customer($customer_id);
                    $id = 0;
                    if ($get_cart_order_of_customer) {
                        while ($result = $get_cart_order_of_customer->fetch_assoc()) {
                            $id++;
                            ?>
                            <tr>
                                <td>
                                    <?php echo $id ?>
                                </td>
                                <td>
                                    <?php echo $result['productName'] ?>
                                </td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
                                <td>
                                    <?php echo $result['price'] ?>
                                </td>
                                <td>
                                    <?php echo $result['quantity']; ?>
                                </td>
                                <td>
                                    <?php
                                    echo $fm->formatDate($result['date_order']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($result['status'] == '0') {

                                        echo 'Pending';
                                    } elseif ($result['status'] == '1') {
                                        ?>
                                        <span>Đang vận chuyển</span>
                                        <?php
                                    } else {
                                        echo 'Received';
                                    }
                                    ?>


                                </td>

                                <?php
                                if ($result['status'] == '0') {
                                    ?>
                                    <td>
                                        <?php echo 'N/A' ?>
                                    </td>
                                    <?php
                                } elseif ($result['status'] == '1') {
                                    ?>
                                    <td> <a href="?confirmid=<?php echo $customer_id ?>">Xác nhận</a> </td>

                                    <?php
                                } else {


                                    ?>
                                    <td><?php echo 'Received';?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>


                </table>
                <!-- <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Total product : </th>
                        <td>
                            <?php
                            echo $totalpro;
                            Session::set('sum', $totalpro);
                            ?>
                        </td>
                    </tr>
                </table> -->
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>

            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>