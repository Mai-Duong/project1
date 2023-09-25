<?php
include 'inc/header.php';
?>
<?php

?>

<div class="main">
    <div class="content">
        <div class="content_top">

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tukhoa = $_POST['tukhoa'];

                $search_product = $product->search_product($tukhoa);
            }
            ?>
            <div class="content_top">

                <div class="heading">
                    <h3>Từ khóa tìm kiếm :
                        <?php echo $tukhoa ?>
                    </h3>
                </div>

                <div class="clear"></div>
            </div>
            <div class="section group">

                <?php
                if ($search_product) {
                    while ($result = $search_product->fetch_assoc()) {

                        ?>

                        <div class="grid_1_of_4 images_1_of_4">
                            <a href="#"> <img src="admin/uploads/<?php echo $result['image'] ?>" width="200px" alt="" />
                            </a>
                            <h2>
                                <?php echo $result['productName'] ?>
                            </h2>
                            <p>
                                <?php echo $fm->textShorten($result['product_desc'], 50) ?>
                            </p>
                            <p><span class="price">
                                    <?php echo $result['price'] . ' ' . 'VNĐ' ?>
                                </span></p>
                            <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>"
                                        class="details">Chi tiết</a></span></div>
                        </div>
                        <?php

                    }
                } else {
                    echo 'Category Not Avaiable';
                }
                ?>
                <style>
                    .images_1_of_4 img {
                        width: 200px;
                        /* Set your desired width */
                        height: 200px;
                        /* Set your desired height */
                    }
                </style>

            </div>



        </div>
    </div>
    <?php include 'inc/footer.php'; ?>