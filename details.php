<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>

<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
	echo "<script>window.location= '404.php' </script> ";
} else {
	$id = $_GET['proid'];
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
// 	$quantity_cart = $_POST['quantity_cart'];
// 	$AddtoCart = $ct->add_to_cart($quantity_cart, $id);
// }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity_stock = $_POST['quantity_stock'];
	 $quantity = $_POST['quantity_cart'];
	$AddtoCart = $ct->add_to_cart($quantity,$quantity_stock, $id);
}
?>

<div class="main">
	<div class="content">
		<div class="section group">

			<?php
			$get_product_details = $product->get_details($id);
			if ($get_product_details) {
				while ($result_datails = $get_product_details->fetch_assoc()) {

					?>

					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_datails['image'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2>
								<?php echo $result_datails['productName'] ?>
							</h2>
							<p>
								<?php echo $result_datails['product_desc'] ?>
							</p>
							<div class="price">
								<p>Giá: <span>
										
										<?php echo number_format($result_datails['price'], 0, '.', ',').' VNĐ'; ?>
									</span></p>
								<p>Thể loại: <span>
										<?php echo $result_datails['catName'] ?>
									</span></p>
								<p>Số lượng:<span>
										<?php echo $result_datails['quantity'] ?>
									</span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="hidden" class="buyfield" name="quantity_stock" value="<?php echo $result_datails['quantity'] ?>"  />
									<input type="number" class="buyfield" name="quantity_cart" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Thêm vào giỏ hàng" />
								</form>
								<?php
								if (isset($AddtoCart)) {
									// echo '<script>alert("Product Already Added");</script>';
									echo $AddtoCart;
								}
								?>
							</div>



						</div>

						<div class="product-desc">
							<h2>Chi tiết sản phẩm</h2>
							<p>
								<?php echo $result_datails['product_desc'] ?>
							</p>


						</div>

					</div>

					<?php
				}
			}
			?>

			<div class="rightsidebar span_3_of_1">
				<h2>Thể loại</h2>
				<ul>

					<?php
					$getall_category = $cat->show_category();
					if ($getall_category) {
						while ($result_allcart = $getall_category->fetch_assoc()) {
							?>
							<li><a href="productbycat.php?catid=<?php echo $result_allcart['catId']?>"><?php echo $result_allcart['catName']?></a></li>
							<?php
						}
					}
					?>
				</ul>

			</div>
		</div>
	</div>
	<?php
	include 'inc/footer.php';
	?>