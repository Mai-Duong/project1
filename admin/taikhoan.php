<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h3>Thông tin admin</h3>
        <?php
        // Check if the admin is logged in
        if (Session::get('adminlogin')) {
            // Retrieve admin's information from session variables
            $adminName = Session::get('adminName');
            $adminEmail = Session::get('adminEmail');
            $adminUser = Session::get('adminUser');
            ?>
            <table class="data display datatable" id="example">
                <tr>
                    <td>Tên admin</td>
                    <td> : </td>
                    <td>
                        <?php echo $adminName; ?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td> : </td>
                    <td>
                        <?php echo $adminEmail; ?>
                        

                    </td>
                </tr>
                <tr>
                    <td>User</td>
                    <td> : </td>
                    <td>
                        <?php echo $adminUser; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <a style="text-align: center ;" href="#">Sửa thông tin</a>
                    </td>
                </tr>
            </table>
            <?php
        } else {
            echo "Bạn không có quyền truy cập trang này.";
        }
        ?>

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


    <div class="clear"></div>
</div>
</div>

<?php include 'inc/adminfooter.php';?> 