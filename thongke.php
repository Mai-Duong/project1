<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/fomat.php');
?>

<?php
class thongke
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_thongke()
    {
        // $query_insert = " INSERT INTO tbl_thongke (doanhthu, donhang, soluong, date_thongke)
        // SELECT

        //     SUM(tbl_order.price) AS doanhthu,
        //     COUNT(tbl_order.productId) AS donhang,
        //     SUM(tbl_order.quantity) AS soluong,
        //     DATE(NOW()) AS date_thongke
        // FROM tbl_order 
        // INNER JOIN tbl_product ON tbl_order.productId = tbl_product.productId
        // WHERE tbl_order.status = 2 ";
        // $result_thongke= $this->db->select($query_insert);
        // return $result_thongke;


        $query_insert = "INSERT INTO tbl_thongke (doanhthu, donhang, soluong, date_thongke)
        SELECT
            SUM(tbl_order.price) AS doanhthu,
            COUNT(tbl_order.productId) AS donhang,
            SUM(tbl_order.quantity) AS soluong,
            DATE(NOW()) AS date_thongke
        FROM tbl_order
        INNER JOIN tbl_placed ON tbl_order.order_code = tbl_placed.order_code
        INNER JOIN tbl_product ON tbl_order.productId = tbl_product.productId
        WHERE tbl_placed.status = 2";

        $result_thongke = $this->db->insert($query_insert);

        return $result_thongke;


    }
}
?>