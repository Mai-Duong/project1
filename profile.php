<?php
include 'inc/header.php';
?>

<div class="main">
    <div class="content">
        <div class="session group">
            <div class="heading">

                <h3>Thông tin khách hàng</h3>
            </div>
        </div>
        <div class="clear"></div>
    </div>


    <table class="tblone">
        <?php
        $id = Session::get('customer_id');
        $get_customers = $cs->customer_shows($id);
        if ($get_customers) {
            while ($result = $get_customers->fetch_assoc()) {

                ?>
                <tr>
                    <td>Tên khách hàng</td>
                    <td> : </td>
                    <td> <?php echo $result['name']?> </td>
                </tr>

                <tr>
                    <td>Thành phố</td>
                    <td> : </td>
                    <td> <?php echo $result['city']?> </td>
                </tr>

                <tr>
                    <td>Số điện thoại</td>
                    <td> : </td>
                    <td> <?php echo $result['phone']?> </td>
                </tr>


                <tr>
                    <td>Email</td>
                    <td> : </td>
                    <td> <?php echo $result['email']?> </td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td> : </td>
                    <td> <?php echo $result['address']?> </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <a href="editprofile.php">Sửa thông tin</a>
                    </td>
                </tr>
                <?php

            }
        }
        ?>
    </table>
</div>
<?php
include 'inc/footer.php';

?>