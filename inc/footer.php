<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Include necessary CSS and JS libraries here -->

    <!-- Example: Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Morris.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

</head>

<body>

    <div class="clear"></div>
    <div class="clear"></div>
    <div id="site_info">
        <p>
            Group 9
            Laptop Thai Nguyen
        </p>
    </div>

    <script>
        $(function () {
            $("#datepicker_from").datepicker({
                dateFormat: 'yy-mm-dd',
                duration: "slow"
            });
            $("#datepicker_to").datepicker({
                dateFormat: 'yy-mm-dd',
                duration: "slow"
            });
        });

        // $(function () {
        //     // Lấy ngày hiện tại
        //     var today = new Date();

        //     // Định dạng ngày tháng thành 'yyyy-MM-dd'
        //     var formattedDate = today.toISOString().substr(0, 10);

        //     // Đặt giá trị mặc định cho input
        //     $("#datepicker_from").val(formattedDate);
        // });

    </script>


    <div id="myfirstchart"></div>

    <script>
        $(document).ready(function () {
            day365();
            var chart = new Morris.Bar({
                element: 'myfirstchart',
                parseTime: false,
                // hideHover: 'auto',
                // data: 
                xkey: 'date',
                ykeys: ['order', 'revenue', 'quantity'],
                labels: ['Số đơn hàng', 'Doanh thu', 'Số lượng']
            });

            $('.btn-locngay').click(function () {
                var from_date = $('.date_from').val();
                var from_to = $('.date_to').val();
                $.ajax(
                    {
                        url: '../ajax/thongke.php',
                        type: 'post',
                        dataType: "JSON",
                        data: { from_date: from_date, from_to: from_to }, //trả về kiểu JSON 
                        success: function (data) {
                            chart.setData(data); //đổ dữ liệu vào biểu đồ 
                            $('#text-date').text(text);
                        }
                    });
            });


            $('.select-thongke').change(function () {
                var thoigian = $(this).val();
                if (thoigian == '7ngay') { //thời gian theo ngày
                    var text = '7 ngày qua';
                } else if (thoigian == '30ngay') {
                    var text = '30 ngày qua';
                } else if (thoigian == '90ngay') {
                    var text = '90 ngày qua';
                } else {
                    var text = '365 ngày qua';
                }
                $('#text-date').text(text);
                $.ajax(
                    {
                        url: '../ajax/thongke.php',
                        type: 'post', dataType: "JSON",
                        cache: false,
                        data: { thoigian: thoigian }, //trả về kiểu JSON 
                        success: function (data) {
                            chart.setData(data); //đổ dữ liệu vào biểu đồ
                        }
                    });
            });


            function day365() {
                var text = '365 ngày qua';
                $('#text-date').text(text);
                $.ajax({
                    url: "../ajax/thongke.php",
                    method: "POST",
                    dataType: "JSON",
                    cache: false,
                    success: function (data) {
                        chart.setData(data);
                    }
                });
            }
        });
    </script>


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

</body>

</html>