<script>
        $(document).ready(function () {
            // Bắt sự kiện click trên mục "Danh mục sản phẩm"
            $(".toggle-submenu").click(function () {
                // Tìm phần tử cha của mục đó (điều này giả định rằng submenu là con trực tiếp của mục cha)
                var parentItem = $(this).parent();

                // Đảm bảo submenu của mục cha đã được chuyển đổi
                if (parentItem.hasClass("active")) {
                    parentItem.removeClass("active");
                } else {
                    parentItem.addClass("active");
                }

                // Ngăn chặn liên kết mặc định để không điều hướng tới trang khác
                return false;
            });
        });

    </script>
<div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
        <p>
          Group 9
        </p>
    </div>
</body>
</html>
