<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>

<!--  -->


<?php

if (isset($_GET['cartid'])) {
	$cartid = $_GET['cartid'];
	$delcart = $ct->del_product_cart($cartid);
	// $thongkeModel->add_to_thongke();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$cartId = $_POST['cartId'];
	$quantity_cart = $_POST['quantity_cart'];
	$update_quantity_cart = $ct->update_quantity_cart($quantity_cart, $cartId);
	if ($quantity_cart <= 0) {
		$delcart = $ct->del_product_cart($cartid);
	}
}
?>



<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Giỏ hàng của bạn</h2>
				<?php
				if (isset($update_quantity_cart)) {
					echo $update_quantity_cart;
				}
				?>
				<?php
				if (isset($delcart)) {
					echo $delcart;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="20%">Tên sản phẩm</th>
						<th width="10%">Hình ảnh</th>
						<th width="15%">Giá</th>
						<th width="25%">Số lượng</th>
						<th width="20%">Thành tiền</th>
						<th width="10%">Hoạt động</th>
					</tr>

					<?php
					$get_product_cart = $ct->get_product_cart();
					if ($get_product_cart) {
						$totalpro = 0;
						$total = 0;
						while ($result = $get_product_cart->fetch_assoc()) {

							?>
							<tr>
								<td>
									<?php echo $result['productName'] ?>
								</td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
								<td>
									<?php echo $result['price'] ?>
								</td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
										<input type="number" name="quantity_cart" min="1"
											value="<?php echo $result['quantity_cart'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td>
									<?php

									$total = $result['price'] * $result['quantity_cart'];
									echo $total;


									?>
								</td>
								<td><a href="?cartid=<?php echo $result['cartId'] ?> ">Xóa</a></td>
							</tr>
							<?php
							$totalpro += $total;
						}
					}
					?>

				</table>
				<?php
				$check_cart = $ct->check_cart();
				if ($check_cart) {

					?>
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Total product : </th>
							<td>
								<?php
								echo $totalpro;
								Session::set('sum', $totalpro);
								?>
							</td>
						</tr>
					</table>
					<?php
				} else {
					echo 'Your cart is empty';
				}
				?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>