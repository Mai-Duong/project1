<?php
require('../tfpdf/tfpdf.php');
include('../classes/cart.php');
include('../classes/customer.php');

// $pdf = new tFPDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial', '', 14);

$pdf = new tFPDF();
$pdf->AddPage();

// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

// Add custom font
// if (!$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true)) {
//     die('Could not load the custom font.');
// }


$pdf->SetFillColor(193, 229, 252);

if (!isset($_GET['code']) || $_GET['code'] == NULL) {
    echo "<script>window.location= '404.php' </script> ";
} else {
    $code = $_GET['code'];
    
}

// $tk = new thongke();
// if (!isset($_GET['code']) || $_GET['code'] == NULL) {
//     echo "<script>window.location= '404.php' </script> ";
// } else {
//     $code = $_GET['code'];
//     $tk = new thongke(); // Tạo đối tượng
//     $result = $tk->add_to_thongke(); // Gọi hàm add_to_thongke từ đối tượng
// }

$cs = new customer();
$customerInf = $cs->customer_shows($code);
$customerInfo = $customerInf->fetch_assoc();


// Kiểm tra xem có thông tin khách hàng hay không
if ($customerInfo) {

    $pageTitle = 'Hóa đơn mua hàng';

    $titleWidth = $pdf->GetStringWidth($pageTitle);
    $xPos = ($pdf->GetPageWidth() - $titleWidth) / 2;

    $pdf->SetX($xPos); // Đặt vị trí bắt đầu của tiêu đề
    $pdf->Cell(0, 5, $pageTitle, 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->Cell(0, 10, 'Thông tin khách hàng', 0, 1, 'L'); // Tiêu đề thông tin khách hàng

    // Hiển thị thông tin khách hàng
    $pdf->Cell(50, 10, 'Tên khách hàng:', 0, 0, 'L');
    $pdf->Cell(0, 10, $customerInfo['name'], 0, 1, 'L');

    $pdf->Cell(50, 10, 'Địa chỉ:', 0, 0, 'L');
    $pdf->Cell(0, 10, $customerInfo['address'], 0, 1, 'L');

    $pdf->Cell(50, 10, 'Thành phố:', 0, 0, 'L');
    $pdf->Cell(0, 10, $customerInfo['city'], 0, 1, 'L');

    // $pdf->Cell(50, 10, 'Mã Zip:', 0, 0, 'L');
    // $pdf->Cell(0, 10, $customerInfo['customer_zipcode'], 0, 1, 'L');
}

$pdf->Write(10, 'Đơn hàng của bạn gồm có:');
$pdf->Ln(10);

// $width_cell = array(10, 80, 20, 35, 35, 35);

$width_cell = array(10, 80, 35, 20, 30, 40);

$pdf->Cell($width_cell[0], 10, 'STT', 1, 0, 'C', true);
$pdf->Cell($width_cell[1], 10, 'Tên sản phẩm', 1, 0, 'C', true);
$pdf->Cell($width_cell[3], 10, 'Số lượng', 1, 0, 'C', true);
$pdf->Cell($width_cell[2], 10, 'Giá', 1, 0, 'C', true);
$pdf->Cell($width_cell[5], 10, 'Thành tiền', 1, 1, 'C', true);
$pdf->SetFillColor(235, 236, 236);
$fill = false;

$ct = new cart();
$cslist = $ct->indonhang($code);
$totalPrice = 0;
if ($cslist) {
    $i = 0;
    while ($row = $cslist->fetch_assoc()) {
        $i++;
        $pdf->Cell($width_cell[0], 10, $i, 1, 0, 'C', $fill);
        $pdf->Cell($width_cell[1], 10, $row['productName'], 1, 0, 'C', $fill);
        $pdf->Cell($width_cell[3], 10, $row['quantity'], 1, 0, 'C', $fill);
        $pdf->Cell($width_cell[2], 10, $row['price'], 1, 0, 'C', $fill);
        $pdf->Cell($width_cell[5], 10, number_format($row['quantity'] * $row['price']), 1, 1, 'C', $fill);
        $fill = !$fill;
        $totalPrice += (($row['quantity'] * $row['price']));
    }
    $pdf->Cell($width_cell[0], 10, '', 0, 0, 'C', false); // Cell trống để giữ vị trí đầu cột
    $pdf->Cell($width_cell[1], 10, '', 0, 0, 'C', false); // Cell trống để giữ vị trí cột "Product Name"
    $pdf->Cell($width_cell[3], 10, '', 0, 0, 'C', false); // Cell trống để giữ vị trí cột "Quantity"
    $pdf->Cell($width_cell[2], 10, 'Tổng tiền', 0, 0, 'C', false); // Cell chứa tiêu đề "Tổng tiền" (đã bỏ đường viền)
    $pdf->Cell($width_cell[5], 10, number_format($totalPrice), 0, 1, 'C', false); // Cell chứa giá trị tổng tiền (đã bỏ đường viền)


}

// $ct = new cart();
// $cslist = $ct->get_cart_ordered_all($code);
// Lấy thông tin khách hàng
$message = 'Cảm ơn bạn đã đặt hàng tại website của chúng tôi.';
$pdf->Ln(5);
$pdf->MultiCell(0, 10, $message);
$pdf->Output();
?>