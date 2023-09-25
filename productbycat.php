<?php
include 'inc/header.php';
?>
<?php
// $cat = new category();
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
	echo "<script>window.location= '404.php' </script> ";

} else {
	$id = $_GET['catid'];
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $catName = $_POST['catName'];

//     $updatCat = $cat->update_category($catName, $id);
// }
?>
<div class="main">
	<div class="content">
		<div class="content_top">

			<?php
			$namcat = $cat->get_name_by_cat($id);
			if ($namcat) {
				while ($result_name = $namcat->fetch_assoc()) {

					?>

					<div class="heading">
						<h3>Thể loại :
							<?php echo $result_name['catName'] ?>
						</h3>
					</div>
					<?php
				}
			}
			?>
			<div class="clear"></div>
		</div>
		<div class="section group">

			<?php
			$productbycat = $cat->get_product_by_cat($id);
			if ($productbycat) {
				while ($result = $productbycat->fetch_assoc()) {

					?>

					<div class="grid_1_of_4 images_1_of_4">
						<a href="#"> <img src="admin/uploads/<?php echo $result['image'] ?>" width="200px" alt="" style="width: 200px;height: 200px;" />
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
									class="details">Chitiết</a></span></div>
					</div>


					<?php

				}
			} else {
				echo 'Category Not Avaiable';
			}
			?>
		</div>



	</div>
</div>
<?php include 'inc/footer.php'; ?>