<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
// if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
//     $customer_id = Session::get('customer_id');
//     $insertOrder = $ct->insertOrder($customer_id);
//     $delCart = $ct->del_all_data_cart();
//     header('Location:success.php');
// }
?>


<style>
    /* CSS cho phần thông báo */
    .order-confirmation {
        text-align: center;
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 10px;
        margin: 0 auto;
        width: 80%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    /* CSS cho các đoạn văn bản bên trong phần thông báo */
    .order-confirmation p {
        font-size: 18px;
        margin: 10px 0;
    }

    /* CSS cho đường dẫn (link) */
    .order-confirmation a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }
</style>
<form>
    <div class="main">
        <div class="content">
            <div class="order-confirmation">
                <h2 style="color:green">Success Order</h2>

                <?php
                $customer_id = Session::get('customer_id');
                $get_amount = $ct->getAmountPrice($customer_id);

                if ($get_amount) {
                    $amount = 0;
                    while ($result = $get_amount->fetch_assoc()) {
                        $price = $result['price'];
                        $amount += $price;
                    }
                }

                ?>
                <p>Đơn hàng bạn đã mua :
                    <?php echo number_format($amount, 0)." VNĐ"; ?>
                </p>

                <p>Chúng tôi sẽ liên hệ ngay khi có thể</p>
                <p>Bạn có thể xem chi tiết của bạn ở đây <a href="history_order.php">Xem</a> </p>
            </div>
        </div>

    </div>
</form>
<?php
include 'inc/footer.php';
?>