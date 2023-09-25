<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>

<?php

// Kiểm tra nếu người dùng đã ấn nút Tìm kiếm
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat = new category();
    $tukhoa = $_POST['tukhoa'];
    $search_cat = $cat->search_cat($tukhoa);
} else {
    // Nếu không có tìm kiếm, hiển thị tất cả danh mục
    $show_cate = $cat->show_category();
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <div class="content_top">
            <div class="heading">
                <h3>Từ khóa tìm kiếm :
                    <?php echo isset($tukhoa) ? $tukhoa : 'Tất cả danh mục'; ?>
                </h3>
            </div>
            <div class="clear"></div>
        </div>

        <h2>Danh sách danh mục</h2>

        <!-- <div class="search-box">
            <form action="searchcat.php" method="post" class="search-form">
                <input type="text" placeholder="Nhập dữ liệu tìm kiếm....." name="tukhoa" class="search-input">
                <input type="submit" name="search_product" value="Tìm kiếm" class="search-button">
            </form>
        </div> -->

        <style>
            /* Các tùy chỉnh CSS cho giao diện tìm kiếm đã ở trên */
        </style>

        <div class="block">
            <?php
            if (isset($delcat)) {
                echo $delcat;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Duyệt qua danh sách danh mục để hiển thị
                    if (isset($search_cat)) {
                        $i = 0;
                        while ($result = $search_cat->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <?php echo $result['catName']; ?>
                                </td>
                                <td>
                                    <a href="catedit.php?catid=<?php echo $result['catId']; ?>">Sửa</a> ||
                                    <a onclick="return confirm('Bạn có chắc chắc muốn xóa không?')"
                                        href="?delid=<?php echo $result['catId']; ?>">Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // Hiển thị tất cả danh mục nếu không có tìm kiếm
                        while ($result = $show_cate->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <?php echo $result['catName']; ?>
                                </td>
                                <td>
                                    <a href="catedit.php?catid=<?php echo $result['catId']; ?>">Sửa</a> ||
                                    <a onclick="return confirm('Bạn có chắc chắc muốn xóa không?')"
                                        href="?delid=<?php echo $result['catId']; ?>">Xóa</a>
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

                /* Các tùy chỉnh CSS cho bảng đã ở trên */
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
