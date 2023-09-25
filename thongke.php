<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
require('../carbon/autoload.php'); //sử dụng carbon lấy ra thứ ngày tháng
use Carbon\Carbon;
use Carbon\CarbonInterval;
?>

<?php
$db = new Database();
if (isset($_POST['thoigian'])) {
    $thoigian = $_POST['thoigian']; //lấy ra thời gian
} else {
    $thoigian = '';
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    //365 ngày
}

if ($thoigian == '7ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString(); //7 ngày 
} elseif ($thoigian == '30ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString(); //28 ngày
} elseif ($thoigian == '90ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString(); //90 ngày 
} elseif ($thoigian == '365ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    //365 ngày
}
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); //lấy time hiện tại
if (isset($_POST['from_date']) && $_POST['from_to']) {

    $from = $_POST['from_date'];

    $to = $_POST['from_to'];

    $query = "SELECT * FROM tbl_thongke WHERE date_thongke BETWEEN '$from' AND '$to' ORDER BY date_thongke ASC"; // 
} else {
    $query = "SELECT * FROM tbl_thongke WHERE date_thongke BETWEEN '$subdays' AND '$now' ORDER BY date_thongke ASC";
}
$result = $db->select($query);
// // dữ liệu là mảng gồm các phần tử phái dưới
foreach ($result as $key => $row) {
    $chart_data[] = array(
        'date' => $row['date_thongke'],
        'order' => $row['donhang'],
        'revenue' => $row['doanhthu'],
        'quantity' => $row['soluong']
    );
}
// print_r($chart_data);
 echo $data = json_encode($chart_data); //echo dữ liệu dạng JSON
?>