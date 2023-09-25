<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/cart.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
?>
<?php
$cat = new category();
if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script>window.location= '404.php' </script> ";
} else {
    $id = $_GET['customerid'];
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $catName = $_POST['catName'];

//     $updatCat = $cat->update_category($catName, $id);
// }

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Chi tiết sản phẩm</h2>
        <div class="block">
                <table class="data display datatable" id="example">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Tên sản phẩm</th>
                        <th width="10%">Hình ảnh</th>
                        <th width="15%">Giá</th>
                        <th width="10%">Số lượng</th>
                        <th width="20%">Ngày</th>
                        <th width="10%">Trạng thái</th>
                    </tr>
                    <?php
                    $ct = new cart();
                    $get_cart_ordered_all = $ct->get_cart_ordered_all($id);
                    $id = 0;
                    if ($get_cart_ordered_all) {
                        while ($result = $get_cart_ordered_all->fetch_assoc()) {
                            $id++;
                            ?>
                            <tr>
                                <td>
                                    <?php echo $id ?>
                                </td>
                                <td>
                                    <?php echo $result['productName'] ?>
                                </td>
                                <td><img src="./uploads/<?php echo $result['image'] ?>" alt="" width="50px" /></td>
                                <td>
                                    <?php echo $result['price'] ?>
                                </td>
                                <td>
                                    <?php echo $result['quantity']; ?>
                                </td>
                                <td>
                                    <?php
                                    $fm = new Format();
                                    echo $fm->formatDate($result['date_order']);
                                    ?>
                                </td>

                                <td>
                                    <?php if($result['status']==0){
                                        echo 'Đã đặt hàng';
                                    }elseif($result['status']==1){
                                        echo 'Đang vận chuyển';
                                    }else{
                                        echo 'Đã nhận';
                                    }
                                    ?>

                                     <!-- <?php echo $result['status']; ?> -->
                                </td>
                                
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

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/adminfooter.php';?> 