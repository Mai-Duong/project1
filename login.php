<?php
include 'inc/header.php';
//  include 'inc/slider.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check) {
	header('Location:index.php');
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

	$insertcustomers = $cs->insert_customers($_POST);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

	$login_customers = $cs->login_customers($_POST);
}
?>
<div class="main">
	<div class="content">
		<div class="login_panel">
			<!-- <h3>Không tồn tại khách hàng</h3> -->
			<h3>Đăng nhập bằng mẫu dưới đây.</h3>
			<?php
			if (isset($login_customers)) {
				echo $login_customers;
			}
			?>
			<form action="" method="POST">
				<input type="text" name="email" class="field" placeholder="Enter email.....">
				<input type="password" name="password" class="field" placeholder="Enter password.....">

				<!-- <p class="note">Nếu bạn quên mật khẩu, chỉ cần nhập email của bạn và nhấp vào <a href="#">đây</a></p> -->
				<div class="buttons">
					<div><input class="custom-button" type="submit" name="login" class="grey" value="Đăng nhập"></input>
					</div>
				</div>
			</form>
		</div>
		<style>
			.login_panel {
				background-color: #ffffff;
				padding: 20px;
				border: 1px solid #e0e0e0;
				border-radius: 5px;
				box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
				max-width: 400px;
				/* margin: 0 auto; */
				margin-bottom: 10px;
				margin-right: 50px;
				margin-left: 50px;
			}

			.login_panel h3 {
				font-size: 18px;
				color: #333;
				text-align: center;
			}

			.field {
				width: 100%;
				padding: 10px;
				margin-bottom: 15px;
				border: 1px solid #e0e0e0;
				border-radius: 5px;
				font-size: 16px;
			}

			.custom-button {
				background-color: #007bff;
				color: #fff;
				padding: 8px 16px;
				/* Giảm padding để nút nhỏ hơn */
				border: none;
				border-radius: 5px;
				cursor: pointer;
				font-size: 16px;
				/* Giảm font-size để nút nhỏ hơn */
				width: 100%;
				transition: background-color 0.3s;
			}

			.custom-button:hover {
				background-color: #0056b3;
			}
		</style>
		<div class="register_account">
			<h3>Đăng ký tài khoản mới</h3>

			<?php
			if (isset($insertcustomers)) {
				echo $insertcustomers;
			}
			?>

			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Nhập tên.......">
								</div>

								<!-- <div>
									<input type="text" name="city" placeholder="Nhập thành phố.......">
								</div> -->
								<div>
									<select id="city" name="city" onchange="change_country(this.value)">
										<option>----- Chọn thành phố-----</option>
										<option>Bắc Giang</option>
										<option>Bắc Kạn</option>
										<option>Bạc Liêu</option>
										<option>Bà Rịa - Vũng Tàu</option>
										<option>Bắc Ninh</option>
										<option>Bến Tre</option>
										<option>Cà Mau</option>
										<option>Cao Bằng</option>
										<option>Đắk Lắk</option>
										<option>Đắk Nông</option>
										<option>Điện Biên</option>
										<option>Đồng Nai</option>
										<option>Đồng Tháp</option>
										<option>Gia Lai</option>
										<option>Hà Giang</option>
										<option>Hà Nam</option>
										<option>Hà Tĩnh</option>
										<option>Hải Dương</option>
										<option>Hậu Giang</option>
										<option>Hòa Bình</option>
										<option>Hưng Yên</option>
										<option>Khánh Hòa</option>
										<option>Kiên Giang</option>
										<option>Kon Tum</option>
										<option>Lai Châu</option>
										<option>Lâm Đồng</option>
										<option>Lạng Sơn</option>
										<option>Lào Cai</option>
										<option>Long An</option>
										<option>Nam Định</option>
										<option>Nghệ An</option>
										<option>Ninh Bình</option>
										<option>Ninh Thuận</option>
										<option>Phú Thọ</option>
										<option>Phú Yên</option>
										<option>Quảng Bình</option>
										<option>Quảng Nam</option>
										<option>Quảng Ngãi</option>
										<option>Quảng Ninh</option>
										<option>Quảng Trị</option>
										<option>Sóc Trăng</option>
										<option>Sơn La</option>
										<option>Tây Ninh</option>
										<option>Thái Bình</option>
										<option>Thái Nguyên</option>
										<option>Thanh Hóa</option>
										<option>Thừa Thiên Huế</option>
										<option>Tiền Giang</option>
										<option>Trà Vinh</option>
										<option>Tuyên Quang</option>
										<option>Vĩnh Long</option>
										<option>Vĩnh Phúc</option>
										<option>Yên Bái</option>
										<option>Thành phố Cần Thơ</option>
										<option>Thành phố Đà Nẵng</option>
										<option>Thành phố Hải Phòng</option>
										<option>Thành phố Hà Nội</option>
										<option>Thành phố Hồ Chí Minh</option>
										<option>Thành phố Hạ Long</option>
										<option>Thành phố Nha Trang</option>
										<option>Thành phố Phan Thiết</option>
										<option>Thành phố Pleiku</option>
									</select>
								</div>


								<!-- <div>
									<input type="text" name="zipcode" oplaceholder="Nhập Zipcode.......">
								</div> -->
								<div>
									<input type="text" name="email" placeholder="Nhật email......">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Nhập địa chỉ address.......">
								</div>


								<div>
									<input type="text" name="phone" placeholder="Số điện thoại......">
								</div>

								<div>
									<input type="text" name="password" placeholder="Mật khẩu......">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<!-- <div><input class="custom-button" type="submit" name="submit" class="grey"
							value="Tạo tài khoàn"></input></div> -->
					<div class="button-container">
						<input class="custom-button" type="submit" name="submit" class="grey" value="Tạo tài khoản">
					</div>
				</div>
				<!-- <p class="terms">Bằng cách nhấp vào 'Tạo tài khoản', bạn đồng ý với <a href="#">Điều kiện </a>. -->
				</p>
				<div class="clear"></div>
			</form>
		</div>

		<style>
			.register_account {
				background-color: #ffffff;
				padding: 20px;
				border: 1px solid #e0e0e0;
				border-radius: 5px;
				box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
				max-width: 800px;
				/* margin: 0 auto; */
			}
			.register_account h3 {
				font-size: 18px;
				color: #333;
				text-align: center;
			}

			.register_account .search {
				text-align: center;
			}



			.register_account input[type="text"],
			.register_account input[type="password"],
			.register_account select {
				width: 100%;
				padding: 10px;
				/* Điều chỉnh khoảng cách giữa nội dung và viền input */
				margin-bottom: 15px;
				/* Khoảng cách giữa các trường nhập */
				border: 1px solid #ccc;
				border-radius: 5px;
				font-size: 16px;
				/* Kích thước font */
			}

			.register_account .custom-button {
				background-color: #007bff;
				color: #fff;
				padding: 8px 16px;
				border: none;
				border-radius: 5px;
				cursor: pointer;
				font-size: 16px;
				width: 100%;
				transition: background-color 0.3s;
			}


			.register_account .custom-button:hover {
				background-color: #0056b3;
			}

			/* Tùy chỉnh khoảng cách giữa các trường nhập */
			.register_account td div {
				margin-bottom: 10px;
			}

			/* Xóa khoảng cách dưới cùng của bảng */
			.register_account table {
				margin-bottom: 0;
			}

			/* Xóa margin và padding của các thẻ p */
			.register_account p {
				margin: 0;
				padding: 0;
			}

			.register_account .search {
				margin-top: 20px;
				text-align: center;
			}

			.register_account .search input.custom-button {
				margin: 0 auto;
				/* Để căn giữa nút tạo tài khoản */
				display: block;
				/* Để nút nằm trên một dòng riêng */
			}


			.register_account .clear {
				clear: both;
			}

			.error {
				color: red;
				size: 10px;
				text-align: center;
			}

			.success {
				color: green;
				size: 10px;
				text-align: center;
			}
		</style>

		<div class="clear"></div>
	</div>
</div>

<?php
include 'inc/footer.php';
?>