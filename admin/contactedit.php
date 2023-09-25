<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/contact.php'; ?>
<?php
$con = new contact();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // $id = $_GET['id'];
    $update_contact = $con->update_contact($_POST);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa thông tin liên hệ</h2>
        <div class="block copyblock">
            <?php
            if (isset($update_contact)) {
                echo $update_contact;
            }
            ?>
            <?php
            $getContactInfo = $con->getContactInfo();
            if ($getContactInfo) {
                while ($result = $getContactInfo->fetch_assoc()) {
                    ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <th scope="row">Điện thoại</th>
                                <td>
                                    <input type="text" name="phone" value="<?php echo $result['phone'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Địa chỉ</th>
                                <td>
                                    <input type="text" name="address" value="<?php echo $result['address'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>
                                    <input type="text" name="email" value="<?php echo $result['email'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Vận chuyển</th>
                                <td>
                                    <input type="text" name="transport" value="<?php echo $result['transport'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Ghi chú</th>
                                <td>
                                    <input type="text" name="note" value="<?php echo $result['note'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" value="Sửa" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/adminfooter.php';?> 