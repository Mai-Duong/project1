<?php
include 'inc/header.php';
?>
<?php
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $updatecustomer = $cs->update_customers($_POST, $id);
}
?>
<div class="main">
    <div class="content">
        <div class="session group">
            <div class="heading">

                <h3>Sửa thông tin</h3>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <form action="" method="POST">
        <table class="tblone">
            <tr>
                <td colspan="2">
                    <?php
                    if (isset($updatecustomer)) {
                        echo $updatecustomer;
                    }
                    ?>
                </td>
            </tr>
            <?php
            $id = Session::get('customer_id');
            $get_customers_edit = $cs->customer_shows($id);
            if ($get_customers_edit) {
                while ($result = $get_customers_edit->fetch_assoc()) {

                    ?>
                    <tr>
                        <td>Họ tên</td>
                        <td> : </td>
                        <td> <input name="name" type="text" value="<?php echo $result['name'] ?>"> </td>
                    </tr>



                    <tr>
                        <td>Số điện thoại</td>
                        <td> : </td>
                        <td> <input name="phone" type="text" value="<?php echo $result['phone'] ?>"> </td>

                    </tr>


                    <tr>
                        <td>Email</td>
                        <td> : </td>
                        <td> <input name="email" type="text" value="<?php echo $result['email'] ?>"> </td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td> : </td>
                        <td> <input name="address" type="text" value="<?php echo $result['address'] ?>"> </td>
                    </tr>
                    <tr>
                        <td>Thành phố</td>
                        <td> : </td>
                        <td>
                            <select id="city" name="city">
                                <?php
                                $cities = array(
                                    "Bắc Giang",
                                    "Bắc Kạn",
                                    "Bạc Liêu",
                                    "Bà Rịa - Vũng Tàu",
                                    "Bắc Ninh",
                                    "Bến Tre",
                                    "Cà Mau",
                                    "Cao Bằng",
                                    "Đắk Lắk",
                                    "Đắk Nông",
                                    "Điện Biên",
                                    "Đồng Nai",
                                    "Đồng Tháp",
                                    "Gia Lai",
                                    "Hà Giang",
                                    "Hà Nam",
                                    "Hà Tĩnh",
                                    "Hải Dương",
                                    "Hậu Giang",
                                    "Hòa Bình",
                                    "Hưng Yên",
                                    "Khánh Hòa",
                                    "Kiên Giang",
                                    "Kon Tum",
                                    "Lai Châu",
                                    "Lâm Đồng",
                                    "Lạng Sơn",
                                    "Lào Cai",
                                    "Long An",
                                    "Nam Định",
                                    "Nghệ An",
                                    "Ninh Bình",
                                    "Ninh Thuận",
                                    "Phú Thọ",
                                    "Phú Yên",
                                    "Quảng Bình",
                                    "Quảng Nam",
                                    "Quảng Ngãi",
                                    "Quảng Ninh",
                                    "Quảng Trị",
                                    "Sóc Trăng",
                                    "Sơn La",
                                    "Tây Ninh",
                                    "Thái Bình",
                                    "Thái Nguyên",
                                    "Thanh Hóa",
                                    "Thừa Thiên Huế",
                                    "Tiền Giang",
                                    "Trà Vinh",
                                    "Tuyên Quang",
                                    "Vĩnh Long",
                                    "Vĩnh Phúc",
                                    "Yên Bái",
                                    // Add more provinces and cities here
                                );
                                foreach ($cities as $city) {
                                    $selected = ($result['city'] == $city) ? 'selected' : '';
                                    echo "<option value=\"$city\" $selected>$city</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <input type="submit" name="save" value="Lưu">
                        </td>
                    </tr>
                    <?php

                }
            }
            ?>
        </table>
    </form>
</div>
<?php
include 'inc/footer.php';

?>