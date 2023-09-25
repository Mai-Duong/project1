<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
?>
<?php
$cat = new category();
if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script>window.location= 'inbox.php' </script> ";
} else {
    $id = $_GET['customerid'];
    $order_code = $_GET['order_code'];
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $catName = $_POST['catName'];

//     $updatCat = $cat->update_category($catName, $id);
// }

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thông tin khách hàng</h2>


        <div class="block copyblock">


            <?php
            $cs = new customer();
            $customer_shows = $cs->customer_shows($id);
            if ($customer_shows) {
                while ($result = $customer_shows->fetch_assoc()) {
                    ?>

                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>Name</td>
                                <td> : </td>
                                <td> <input readonly="readonly" name="name" type="text" value="<?php echo $result['name'] ?>">
                                </td>
                            </tr>

                            <tr>
                                <td>City</td>
                                <td> : </td>
                                <td> <input readonly="readonly" type="text" value=" <?php echo $result['city'] ?>"> </td>

                            </tr>

                            <tr>
                                <td>Phone</td>
                                <td> : </td>
                                <td> <input readonly="readonly" name="phone" type="text" value="<?php echo $result['phone'] ?>">
                                </td>

                            </tr>


                   

                            <tr>
                                <td>Email</td>
                                <td> : </td>
                                <td> <input readonly="readonly" name="email" type="text" value="<?php echo $result['email'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td> : </td>
                                <td> <input readonly="readonly" name="address" type="text"
                                        value="<?php echo $result['address'] ?>"> </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <a href="inbox.php"
                                        style="text-decoration: none; background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px;">Back</a>

                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                }
            }
            ?>
        </div>

        <table class="data display datatable" id="example" >
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $cs = new customer();
            $get_order = $cs->show_order($order_code);
            if ($get_order) {
                $subtotal = 0;
                $total = 0;
                while ($result_order = $get_order->fetch_assoc()) {
                $subtotal = $result_order['quantity']*$result_order['price'];
                $total += $subtotal;
                    ?>
                <tr>
                    <td><?php echo $result_order['productName']?></td>
                    <td><?php echo $result_order['price']?></td>
                    <td><?php echo $result_order['quantity']?></td>
                    <td><?php echo $subtotal?> </td>
                </tr>
                <?php
                }
            }
            ?>
            <td colspan="5">Tổng tiền : <?php echo $total?> VNĐ </td>
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
<?php include 'inc/adminfooter.php';?> 