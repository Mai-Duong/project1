<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php' ?>
<?php include '../classes/product.php' ?>
<?php include_once '../helpers/fomat.php' ?>
<?php
$pd = new product();
$fm = new Format();
if (isset($_GET['productid'])) {
	$id = $_GET['productid'];
	$delpro = $pd->del_product($id);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách sản phẩm</h2>

		<div class="search-box">
			<form action="" method="post" class="search-form">
				<input type="text" placeholder="Nhập dữ liệu tìm kiếm....." name="tukhoa" class="search-input">
				<input type="submit" name="search_product" value="Tìm kiếm" class="search-button">
			</form>
		</div>

		<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {//Kiểm tra tr web đã đc y/c bằng phương thức post hay chưa
			$tukhoa = $_POST['tukhoa'];
			$search_product_admin = $pd->search_product_admin($tukhoa);
		} else {
			$pdlist = $pd->show_product();
		}
		?>

		<style>
			.search-box {
				display: flex;
				align-items: center;
				justify-content: center;
				margin-top: 20px;
			}

			.search-form {
				display: flex;
				gap: 10px;
			}

			.search-input {
				padding: 10px;
				border: 2px solid #007bff;
				border-radius: 5px 0 0 5px;
				font-size: 16px;
				flex-grow: 1;
			}

			.search-button {
				padding: 10px 20px;
				background-color: #007bff;
				color: #fff;
				border: none;
				border-radius: 0 5px 5px 0;
				cursor: pointer;
				font-size: 16px;
			}

			/* Để thay đổi màu nền của nút khi hover, bạn có thể sử dụng pseudoclass :hover */
			.search-button:hover {
				background-color: #0056b3;
			}
		</style>

		<div class="block">
			<?php
			if (isset($delpro)) {
				echo $delpro;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên sản phẩm</th>
						<th>Giá</th>
						<th>Hình ảnh</th>
						<th>Thể loại</th>
						<th>Số lượng</th>
						<th>Mô tả</th>
						<th>Thể loại</th>
						<th>Hoạt động</th>
					</tr>
				</thead>
				<tbody>

					<?php
					// Duyệt qua danh sách danh mục để hiển thị
					if (isset($search_product_admin)) {
						if (is_object($search_product_admin) && $search_product_admin->num_rows > 0) {
							$i = 0;
							while ($result = $search_product_admin->fetch_assoc()) {
								$i++;
								?>

								<tr class="odd gradeX">
									<td>
										<?php echo $i ?>
									</td>
									<td>
										<?php echo $result['productName'] ?>
									</td>
									<td>

										<?php echo number_format($result['price'], 0, '.', ',') . ' VNĐ'; ?>
									</td>
									<td>
										<img src="uploads/<?php echo $result['image'] ?>" width="80">
									</td>
									<td>
										<?php echo $result['catName'] ?>
									</td>
									<td>
										<?php echo $result['quantity'] ?>
									</td>
									<td>
										<?php
										echo $fm->textShorten($result['product_desc'], 30);
										?>


									</td>
									<td>
										<?php
										if ($result['type'] == 0) {
											echo 'Feathered';
										} else {
											echo 'Non-Feathered';
										}
										?>
									</td>
									<!-- <td class="center"> 4</td> -->
									<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> || <a
											onclick="return confirm('Bạn có chắc chắc muốn xóa không?')"
											href="?productid=<?php echo $result['productId'] ?>">Xóa</a></td>
								</tr>
								<?php
							}
						} else {
							echo 'Không tìm thấy dữ liệu';
						}
					} else {
						// Hiển thị tất cả danh mục nếu không có tìm kiếm
						$i = 0;
						while ($result = $pdlist->fetch_assoc()) {
							$i++;
							?>

							<tr class="odd gradeX">
								<td>
									<?php echo $i ?>
								</td>
								<td>
									<?php echo $result['productName'] ?>
								</td>
								<td>

									<?php echo number_format($result['price'], 0, '.', ',') . ' VNĐ'; ?>
								</td>
								<td>
									<img src="uploads/<?php echo $result['image'] ?>" width="80">
								</td>
								<td>
									<?php echo $result['catName'] ?>
								</td>
								<td>
									<?php echo $result['quantity'] ?>
								</td>
								<td>
									<?php
									echo $fm->textShorten($result['product_desc'], 30);
									?>


								</td>
								<td>
									<?php
									if ($result['type'] == 0) {
										echo 'Feathered';
									} else {
										echo 'Non-Feathered';
									}
									?>
								</td>
								<!-- <td class="center"> 4</td> -->
								<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> || <a
										onclick="return confirm('Bạn có chắc chắc muốn xóa không?')"
										href="?productid=<?php echo $result['productId'] ?>">Xóa</a></td>
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