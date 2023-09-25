<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$getLastestOne = $product->getLastestOne();
			if ($getLastestOne) {
				while ($resultone = $getLastestOne->fetch_assoc()) {
					?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $resultone['productId'] ?>"> <img
									src="admin/uploads/<?php echo $resultone['image'] ?> " alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Dell</h2>
							<p>
								<?php echo $resultone['productName'] ?>
							</p>
							<div class="button"><span><a href="details.php?proid=<?php echo $resultone['productId'] ?>"
										class="details">Chi tiết</a></span></div>
						</div>
					</div>
					<?php
				}
			}
			?>
			<?php
			$getLastestTwo = $product->getLastestTwo();
			if ($getLastestTwo) {
				while ($resulttwo = $getLastestTwo->fetch_assoc()) {
					?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $resulttwo['productId'] ?>"> <img
									src="admin/uploads/<?php echo $resulttwo['image'] ?> " alt="" /></a>

						</div>
						<div class="text list_2_of_1">
							<h2>Asus</h2>
							<p>
								<?php echo $resulttwo['productName'] ?>
							</p>

							<div class="button"><span><a href="details.php?proid=<?php echo $resulttwo['productId'] ?>"
										class="details">Chi tiết</a></span></div>
						</div>
					</div>
				</div>
				<?php
				}
			}
			?>


		<!--  -->
		<div class="section group">
			<?php
			$getLastestThree = $product->getLastestThree();
			if ($getLastestThree) {
				while ($resultthree = $getLastestThree->fetch_assoc()) {
					?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?php echo $resultthree['image'] ?> " alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Aser</h2>
							<p>
								<?php echo $resultthree['productName'] ?>
							</p>
							<div class="button"><span><a href="details.php?proid=<?php echo $resultthree['productId'] ?>"
										class="details">Chi tiết</a></span></div>
						</div>
					</div>
					<?php
				}
			}
			?>
			<?php
			$getLastestFour = $product->getLastestFour();
			if ($getLastestFour) {
				while ($resultfour = $getLastestFour->fetch_assoc()) {
					?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $resultfour['productId'] ?>"> <img
									src="admin/uploads/<?php echo $resultfour['image'] ?> " alt="" /></a>

						</div>
						<div class="text list_2_of_1">
							<h2>HP</h2>
							<p>
								<?php echo $resultfour['productName'] ?>
							</p>

							<div class="button"><span><a href="details.php?proid=<?php echo $resultfour['productId'] ?>"
										class="details">Chi tiết</a></span></div>
						</div>
					</div>
				</div>
				<?php
				}
			}
			?>
		<!--  -->
		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<!--  -->
					<?php
					$getLastestOne = $product->getLastestOne();
					if ($getLastestOne) {
						while ($resultone = $getLastestOne->fetch_assoc()) {
							?>
							<li><img src="admin/uploads/<?php echo $resultone['image'] ?> " alt="" /></li>
							<?php
						}
					}
					?>

					<?php
					$getLastestTwo = $product->getLastestTwo();
					if ($getLastestTwo) {
						while ($resulttwo = $getLastestTwo->fetch_assoc()) {
							?>
							<li><img src="admin/uploads/<?php echo $resulttwo['image'] ?> " alt="" /></li>
							<?php
						}
					}
					?>
					<?php
					$getLastestThree = $product->getLastestThree();
					if ($getLastestOne) {
						while ($resultthree = $getLastestThree->fetch_assoc()) {
							?>
							<li><img src="admin/uploads/<?php echo $resultthree['image'] ?> " alt="" /></li>
							<?php
						}
					}
					?>
					<?php
					$getLastestFour = $product->getLastestFour();
					if ($getLastestFour) {
						while ($resultfour = $getLastestFour->fetch_assoc()) {
							?>
							<li><img src="admin/uploads/<?php echo $resultfour['image'] ?> " alt="" /></li>
							<?php
						}
					}
					?>
					<!-- <li><img src="images/2.jpg" alt="" /></li>
					<li><img src="images/3.jpg" alt="" /></li>
					<li><img src="images/4.jpg" alt="" /></li> -->

					<!-- <li><img src="images/3.jpg" alt="" /></li>
			<li><img src="images/4.jpg" alt="" /></li> -->
				</ul>
				<style>
					.slides li img {
						width: 300px;
						/* Set your desired width */
						height: 200px;
						/* Set your desired height */
					}
				</style>

			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>