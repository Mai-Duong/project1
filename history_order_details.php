<?php
include 'inc/header.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>


<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3 class="payment">Lịch sử đơn đã đặt chi tiết</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">


                    <table class="data display datatable" id="example">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cs = new customer();
                            $order_code = $_GET['order_code'];
                            $get_order = $cs->show_order($order_code);
                            if ($get_order) {
                                $subtotal = 0;
                                $total = 0;
                                while ($result_order = $get_order->fetch_assoc()) {
                                    $subtotal = $result_order['quantity'] * $result_order['price'];
                                    $total += $subtotal;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $result_order['productName'] ?>
                                        </td>
                                        <td><img src="admin/uploads/<?php echo $result_order['image'] ?>" alt="" width="80px" /></td>

                                        <td>
                                            <?php echo $result_order['price'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result_order['quantity'] ?>
                                        </td>
                                        <td>
                                            <?php echo $subtotal ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <td colspan="5">Tổng tiền :
                                <?php echo $total ?> VNĐ
                            </td>
                        </tbody>
                    </table>

                    <style>
                        /* Định dạng bảng chung */
                        #example {
                            width: 100%;
                            border-collapse: collapse;
                        }

                        /* Định dạng dòng tiêu đề */
                        #example thead {
                            background-color: #333;
                            color: #fff;
                        }

                        #example th {
                            padding: 10px;
                            text-align: left;
                        }

                        /* Định dạng dòng chẵn */
                        #example tbody tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }

                        /* Định dạng dòng lẻ */
                        #example tbody tr:nth-child(odd) {
                            background-color: #fff;
                        }

                        #example td {
                            padding: 10px;
                        }

                        /* Định dạng hover */
                        #example tbody tr:hover {
                            background-color: #ccc;
                        }
                    </style>

                </div>
            </div>
        </div>
    </div>

    <?php
    include 'inc/footer.php';

    ?>