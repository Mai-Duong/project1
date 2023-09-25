</div>
<div class="footer">
	<div class="wrapper">
		<div class="section group">
			<div class="col_1_of_3 span_1_of_4">
				<h4>Hỗ trợ khách hàng</h4>
				<ul>
					<li><a href="#"><span>Thẻ ưu đãi</span></a></li>
					<li><a href="#"><span>Hướng dẫn mua online</span></a></li>
					<li><a href="#"><span>
								Ưu đãi dành cho doanh nghiệp
								</span></a></li>
					<li><a href="#"><span>
							Chính sách trả góp
							</span></a></li>
					<li><a href="#"><span>
								Dịch vụ sửa chữa
								</span></a></li>
				</ul>
			</div>
			<div class="col_1_of_3 span_1_of_4">
				<h4>Chính sách mua hàng</h4>
				<ul>
					<li><a href="#"><span>Điều kiện giao dịch chung</span></a></li>
					<li><a href="#"><span>Chính sách bảo hành</span></a></li>
					<li><a href="#"><span>Privacy Policy</span></a></li>
					<li><a href="#"><span>Chính sách đổi trả</span></a></li>
					<li><a href="#"><span>Chính sách thanh toán</span></a></li>
					<li><a href="#"><span>Giao hàng và lắp đặt</span></a></li>
				</ul>
			</div>
			<div class="col_1_of_3 span_1_of_4">
				<h4>Thông tin liên hệ</h4>
				<ul>
					<li><span>Email: laptoptn@gmail.com</span></li>
					<li><span>SĐT : 0987654321</span></li>
				</ul>
				<div class="social-icons">
					<h4>Theo dõi chúng tôi</h4>
					<ul>
						<li class="facebook"><a href="#" target="_blank"> </a></li>
						<li class="twitter"><a href="#" target="_blank"> </a></li>
						<li class="googleplus"><a href="#" target="_blank"> </a></li>
						<li class="contact"><a href="#" target="_blank"> </a></li>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
		</div>
		<div class="copy_right">
			<p>Group 9 </p>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		/*
		var defaults = {
				containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/

		$().UItoTop({ easingType: 'easeOutQuart' });

	});
</script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
	$(function () {
		SyntaxHighlighter.all();
	});
	$(window).load(function () {
		$('.flexslider').flexslider({
			animation: "slide",
			start: function (slider) {
				$('body').removeClass('loading');
			}
		});
	});
</script>
</body>

</html>