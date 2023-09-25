<?php
include 'inc/header.php';
?>


<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>

<?php
if (isset($_GET['danhanhang'])) {
    $danhanhang = $_GET['danhanhang'];
    $danhanhang = $ct->confirm_received($danhanhang);

    // if ($danhanhang && isset($danhanhang['status']) && $danhanhang['status'] == 2) {
    //     $tk = new thongke(); // Tạo đối tượng
    //     $result = $tk->add_to_thongke(); // Gọi hàm add_to_thongke từ đối tượng
    // }
}
?>

<?php
$ct = new cart();
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $del_shifted = $ct->del_shifted($id);

}
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3 class="payment">Lịch sử đơn đã đặt</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                    <table class="data display datatable" id="example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ngày đặt</th>
                                <th>Mã Code</th>
                                <th>ID khách hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Hoạt động</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_inbox_cart = $ct->get_inbox_cart_history(Session::get('customer_id'));
                            if ($get_inbox_cart) {
                                $i = 0;

                                
                                $tkExecuted = false; // Khởi tạo biến để đánh dấu
                                while ($result = $get_inbox_cart->fetch_assoc()) {
                                    $i++;
                                    ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td>
                                            <?php echo $fm->formatDate($result['date_created']) ?>
                                        </td>
                                        <td>
                                            <?php echo $result['order_code'] ?>
                                        </td>

                                        <td>
                                            <?php echo $result['customer_id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result['name'] ?>
                                        </td>

                                        <td> <a
                                                href="history_order_details.php?customerid=<?php echo $result['customer_id'] ?>&order_code=<?php echo $result['order_code'] ?>">
                                                Chi tiết đơn hàng </a>
                                        </td>
                                        <td>
                                            <?php
                                            if ($result['status'] == 1) {
                                                ?>
                                                <a href="?danhanhang=<?php echo $result['order_code'] ?>">Đã nhận hàng</a>
                                                <?php
                                            } elseif ($result['status'] == 2) {
                                                ?>
                                                <?php echo 'Đơn hàng thành công... '; ?>

                                                <?php
                                                $tk = new thongke(); // Tạo đối tượng
                                                $result = $tk->add_to_thongke(); // Gọi hàm add_to_thongke từ đối tượng
                                                $tkExecuted = true; // Đánh dấu đã thực hiện
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php


                                }
                            }




                            ?>

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