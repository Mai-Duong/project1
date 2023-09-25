<?php
include 'inc/header.php';
include 'inc/slider.php';
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Sản phẩm nổi bật</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">

			<?php
			$getproduct_feathered = $product->getproduct_feathered();
			if ($getproduct_feathered) {
				while ($result = $getproduct_feathered->fetch_assoc()) {
					?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
						<h2>
							<?php echo $result['productName'] ?>
						</h2>
						<p>
							<?php echo $fm->textShorten($result['product_desc'], 50) ?>
						</p>
						<p><span class="price">
								<?php echo number_format($result['price'], 0, '.', ',') . ' VNĐ'; ?>
							</span></p>

						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>"
									class="details">Chi tiết</a></span></div>
					</div>
					<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>Sản phẩm mới</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">

			<?php
			$getproduct_new = $product->getproduct_new();
			if ($getproduct_new) {
				while ($result_new = $getproduct_new->fetch_assoc()) {
					?>

					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
						<h2>
							<?php echo $result_new['productName'] ?>
						</h2>
						<p>
							<?php echo $fm->textShorten($result_new['product_desc'], 50) ?>
						</p>
						<p><span class="price">
								<?php echo number_format($result_new['price'], 0, '.', ',') . ' VNĐ'; ?>
							</span></p>

						<div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'] ?>"
									class="details">Chi tiết</a></span></div>
					</div>
					<?php
				}
			}
			?>
			<style>
				.images_1_of_4 img {
					width: 250px;
					/* Set your desired width */
					height: 200px;
					/* Set your desired height */
				}
			</style>

		</div>
		<div style="text-align: center">
			<?php
			$all_product = $product->get_all_product();
			$product_count = mysqli_num_rows($all_product);
			$products_per_page = 4;
			$product_button = ceil($product_count / $products_per_page);

			// Lấy trang hiện tại từ tham số trang
			$current_page = isset($_GET['trang']) ? $_GET['trang'] : 1;

			for ($i = 1; $i <= $product_button; $i++) {
				$start_index = ($i - 1) * $products_per_page;
				$end_index = $start_index + $products_per_page - 1;

				echo '<a style="margin:0 5px;text-align: center" href="index.php?trang=' . $i . '">' . $i . '</a>';
			}
			?>


		</div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>