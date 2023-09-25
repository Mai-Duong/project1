<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php include '../classes/contact.php'; ?>
<?php
$con = new contact();
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thông tin liên hệ</h2>

        <div class="block">
            <?php
            $getContactInfo = $con->getContactInfo();
            if (isset($getContactInfo)) {
                while ($result = $getContactInfo->fetch_assoc()) {
                    ?>

                    <table class="table table-hover">
                        <thead>
                            <!-- <tr>
                                <th scope="col">Tiêu đề</th>
                                <td scope="col">Nội dung</td>
                            </tr> -->
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Điện thoại</th>
                                <td>
                                    <?php echo $result['phone'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Địa chỉ</th>
                                <td>
                                    <?php echo $result['address'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>
                                    <?php echo $result['email'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Vận chuyển</th>
                                <td>
                                    <?php echo $result['transport'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Ghi chú</th>
                                <td>
                                    <?php echo $result['note'] ?>
                                </td>

                            </tr>
                        </tbody>
                    </table>

                    <a class="edit-button" style="text-align: center;" href="contactedit.php?<?php echo $result['id'] ?>">Sửa</a>


                    <?php
                }
            }
            ?>



            <style>
                /* Style the table */
                .table {
                    width: 100%;
                    border-collapse: collapse;
                }

                /* Style table header */
                .table th {
                    background-color: #f2f2f2;
                    text-align: left;
                    padding: 10px;
                }

                /* Style table rows */
                .table td {
                    border: 1px solid #e1e1e1;
                    padding: 10px;
                }

                /* Style alternating rows */
                .table tbody tr:nth-child(even) {
                    background-color: #f9f9f9;
                }

                /* Style table header text */
                .table th {
                    font-weight: bold;
                }

                /* Style table cell text */
                .table td {
                    font-weight: normal;
                }

                /* Style the edit button */
                .edit-button {
                    display: inline-block;
                    padding: 10px 20px;
                    /* Adjust padding as needed */
                    background-color: #007BFF;
                    /* Background color for the button */
                    color: #fff;
                    /* Text color */
                    text-align: center;
                    text-decoration: none;
                    border-radius: 4px;
                    /* Rounded corners */
                    transition: background-color 0.3s;
                    /* Smooth background color transition */
                }

                /* Hover effect for the button */
                .edit-button:hover {
                    background-color: #0056b3;
                    /* New background color on hover */
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