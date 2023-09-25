<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
// $filepath = realpath(dirname(__FILE__));
// include_once($filepath . '/../lib/database.php');
// include_once($filepath . '/../helpers/fomat.php');
include_once('../classes/thongke.php'); // Import lớp thongke

$tk = new thongke(); // Tạo đối tượng thongkeModel
?>
<!--  -->
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
require('../carbon/autoload.php'); //sử dụng carbon lấy ra thứ ngày tháng
use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); //lấy time hiện tại
?>
<!--  -->


<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
?>

<?php
$ct = new cart();
if (isset($_GET['shiftid'])) {
	$id = $_GET['shiftid'];
	$shifted = $ct->shifted($id);
	$tk = new thongke();
	// $tk->add_to_thongke();
}
?>

<?php
$ct = new cart();
$fm = new Format();
if (isset($_GET['delid'])) {
	$id = $_GET['delid'];
	$del_shifted = $ct->del_shifted($id);
}
?>



<div class="grid_10">
	<div class="box round first grid">
		<h2>Hóa đơn</h2>


		<div class="search-box">
			<form action="" method="post" class="search-form">
				<input type="text" placeholder="Nhập dữ liệu tìm kiếm....." name="tukhoa" class="search-input">
				<input type="submit" name="search_product" value="Tìm kiếm" class="search-button">
			</form>
		</div>

		<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$tukhoa = $_POST['tukhoa'];
			$search_inbox = $ct->search_inbox($tukhoa);
		} else {
			$get_inbox_cart = $ct->get_inbox_cart();
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
			if (isset($shifted)) {
				echo $shifted;
			}
			?>
			<?php
			if (isset($del_shifted)) {
				echo $del_shifted;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Thời gian</th>
						<th>Mã Code</th>
						<th>Id khách hàng</th>
						<th>Tên khách hàng</th>
						<th>Hoạt động</th>
						<th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>

					<?php
					if (isset($search_inbox)) {
						if (is_object($search_inbox) && $search_inbox->num_rows > 0) {
							$i = 0;
							while ($result = $search_inbox->fetch_assoc()) {
								$i++;
								?>
								<tr class="odd gradeX">
									<td>
										<?php echo $i ?>
									</td>
									<td>
										<?php echo $fm->formatDate($result['date_created']) ?>
									</td>
									<td>
										<?php echo $result['order_code'] ?>
									</td>

									<td>
										<?php echo $result['customer_id'] ?>
									</td>
									<td>
										<?php echo $result['name'] ?>
									</td>

									<td> <a
											href="customer.php?customerid=<?php echo $result['customer_id'] ?>&order_code=<?php echo $result['order_code'] ?>">Xem
											hóa đơn </a>
										|| <a href="indonhang.php?code=<?php echo $result['id'] ?>">In hóa đơn</a>
									</td>
									<td>
										<?php
										if ($result['status'] == '0') {
											?>
											<a href="?shiftid=<?php echo $result['order_code'] ?>">Tình trạng mới</a>
											<?php
										} elseif ($result['status'] == '1') {
											?>
											<?php echo 'Đang vận chuyển... '; ?>
											<?php
										} else {
											?>
											<a href="?delid=<?php echo $result['order_code'] ?>" class="delete-link"
												onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Đã nhận | Xóa</a>

											<?php
										}

										?>
									</td>
								</tr>
								<?php
							}
						} else {
							echo 'Không tìm thấy dữ liệu';
						}
					} else {
						$i = 0;
						while ($result = $get_inbox_cart->fetch_assoc()) {
							$i++;
							?>
							<tr class="odd gradeX">
								<td>
									<?php echo $i ?>
								</td>
								<td>
									<?php echo $fm->formatDate($result['date_created']) ?>
								</td>
								<td>
									<?php echo $result['order_code'] ?>
								</td>

								<td>
									<?php echo $result['customer_id'] ?>
								</td>
								<td>
									<?php echo $result['name'] ?>
								</td>

								<td> <a
										href="customer.php?customerid=<?php echo $result['customer_id'] ?>&order_code=<?php echo $result['order_code'] ?>">Xem
										hóa đơn </a>
									|| <a href="indonhang.php?code=<?php echo $result['id'] ?>">In hóa đơn</a>
								</td>
								<td>
									<?php
									if ($result['status'] == '0') {
										?>
										<a href="?shiftid=<?php echo $result['order_code'] ?>">Tình trạng mới</a>
										<?php
									} elseif ($result['status'] == '1') {
										?>
										<?php echo 'Đang vận chuyển... '; ?>
										<?php
									} else {
										?>
										<a href="?delid=<?php echo $result['order_code'] ?>" class="delete-link"
												onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Đã nhận | Xóa</a>
										<?php
									}

									?>
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
<?php include 'inc/adminfooter.php'; ?>