<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php include '../classes/category.php'; ?>
<?php
$cat = new category();
if (isset($_GET['delid'])) {
	$id = $_GET['delid'];
	$delcat = $cat->del_category($id);

}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách danh mục</h2>

		<div class="search-box">
			<form action="" method="post" class="search-form">
				<input type="text" placeholder="Nhập dữ liệu tìm kiếm....." name="tukhoa" class="search-input">
				<input type="submit" name="search_product" value="Tìm kiếm" class="search-button">
			</form>
		</div>


		<?php

		// Kiểm tra nếu người dùng đã ấn nút Tìm kiếm
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// $cat = new category();
			$tukhoa = $_POST['tukhoa'];
			$search_cat = $cat->search_cat($tukhoa);
		} else {
			// Nếu không có tìm kiếm, hiển thị tất cả danh mục
			$show_cate = $cat->show_category();
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
						if (is_object($search_cat) && $search_cat->num_rows > 0) {
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
							echo 'Không tìm thấy dữ liệu';
						}
					} else {
						// Hiển thị tất cả danh mục nếu không có tìm kiếm
						$i = 0;
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