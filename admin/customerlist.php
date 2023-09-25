<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php' ?>
<?php include '../classes/product.php' ?>
<?php include '../classes/customer.php' ?>
<?php include '../classes/cart.php' ?>
<?php include_once '../helpers/fomat.php' ?>
<?php
$ct = new cart();
$fm = new Format();
$cs = new customer();

// if (isset($_GET['customerid'])) {
// 	$id = $_GET['customerid'];
// 	$delpro = $pd->del_product($id);

// }
?>

<div class="grid_10">
    <div class="box round first grid">

        <div class="search-box">
            <form action="" method="post" class="search-form">
                <input type="text" placeholder="Nhập dữ liệu tìm kiếm....." name="tukhoa" class="search-input">
                <input type="submit" name="search_product" value="Tìm kiếm" class="search-button">
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tukhoa = $_POST['tukhoa'];
            $search_customer = $cs->search_customer($tukhoa);
        } else {
            $search_customer = $cs->get_all_product_customer_ordered();
        }
        ?>

        <style>
            .search-box {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-top: 20px;
            }

            .search-form {
                display: flex;
                gap: 10px;
            }

            .search-input {
                padding: 10px;
                border: 2px solid #007bff;
                border-radius: 5px 0 0 5px;
                font-size: 16px;
                flex-grow: 1;
            }

            .search-button {
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 0 5px 5px 0;
                cursor: pointer;
                font-size: 16px;
            }

            /* Để thay đổi màu nền của nút khi hover, bạn có thể sử dụng pseudoclass :hover */
            .search-button:hover {
                background-color: #0056b3;
            }
        </style>

        <h2>Danh sách khách hàng</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Thành phố</th>
                        <th>Điện thoại</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    if (isset($search_customer)) {
                        if (is_object($search_customer) && $search_customer->num_rows > 0) {
                            $i = 0;
                            while ($result = $search_customer->fetch_assoc()) {
                                $i++;
                                ?>

                                <tr class="odd gradeX">
                                    <td>
                                        <?php echo $i ?>
                                    </td>
                                    <td>
                                        <?php echo $result['name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['address'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['city'] ?>

                                    </td>
                                    <td>
                                        <?php echo $result['phone'] ?>
                                    </td>

                                    <td> <a href="customerordered.php?customerid=<?php echo $result['id'] ?>">Thông tin sản phẩm của khách hàng
                                            <!-- </a> || <a href="indonhang.php?code=<?php echo $result['id'] ?>">In hóa đơn</a> -->
                                    </td>

                                </tr>
                                <?php

                            }
                        } else {
                            echo 'Không tìm thấy dữ liệu';
                        }
                    } else {
                        // Hiển thị tất cả danh mục nếu không có tìm kiếm
                        $i = 0;
                        while ($result = $cslist->fetch_assoc()) {
                            $i++;
                            ?>

                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>
                                    <?php echo $result['name'] ?>
                                </td>
                                <td>
                                    <?php echo $result['address'] ?>
                                </td>
                                <td>
                                    <?php echo $result['city'] ?>

                                </td>
         
                                <td>
                                    <?php echo $result['phone'] ?>
                                </td>

                                <td> <a href="customerordered.php?customerid=<?php echo $result['id'] ?>">Sản phẩm
                                        <!-- </a> || <a href="indonhang.php?code=<?php echo $result['id'] ?>">In hóa đơn</a> -->
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

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/adminfooter.php';?> 