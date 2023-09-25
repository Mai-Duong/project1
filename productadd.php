<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'?>
<?php include '../classes/product.php'?>


<?php
$pd = new product();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){

	$insertProduct = $pd->insert_product($_POST,$_FILES);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">
        <?php
                if(isset($insertProduct)){
                    echo $insertProduct;
                }
                ?>
            <form action="productadd.php" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Tên sản phẩm</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Nhập tên sản phẩm..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Thể loại</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                            <option>--------Chọn thể loại--------</option>
                                <?php   
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while($result= $catlist->fetch_assoc()){                           
                                ?>                                
                                <option value="<?php echo $result['catId']?>"><?php echo $result['catName']?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Số lượng</label>
                        </td>
                        <td>
                            <input type="number" min="1" name="quantity" placeholder="Nhập số lượng..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Mô tả</label>
                        </td>
                        <td>
                            <textarea name="product_desc" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Giá</label>
                        </td>
                        <td>
                            <input name="price" type="text" placeholder="Giá sản phẩm..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Hình ảnh</label>
                        </td>
                        <td>
                            <input name="image" type="file" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Kiểu sản phẩm</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Chọn kiểu</option>
                                <option value="1">Nổi bật</option>
                                <option value="0">Không nổi bật</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/adminfooter.php';?> 