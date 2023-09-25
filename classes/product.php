<?php
// include '../lib/database.php';
// include '../helpers/fomat.php';
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/fomat.php');
?>

<?php
class product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        // kt hinh anh va lay hinh anh cho vao folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 8, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;


        if ($productName == "" || $quantity == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == "") {
            $alert = "<span class ='error'>Không được bỏ trống các trường</span> ";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName,quantity,catId,product_desc,price,type,image) VALUE('$productName','$quantity','$category','$product_desc','$price','$type','$unique_image') ";
            $result = $this->db->insert($query);
            // true pass, user
            if ($result) {
                $alert = "<span class ='success'>Thêm sản phẩm thành công</span> ";
                return $alert;
            } else {
                $alert = "<span class ='success'>Thêm sản phẩm không thành công</span> ";
                return $alert;
            }
        }
    }

    public function show_product()
    {
        $query = "SELECT tbl_product.*, tbl_category.catName FROM tbl_product, tbl_category WHERE tbl_category.catId = tbl_product.catId ORDER BY productId desc ";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        // Check allowed image formats
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 8, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $quantity == "" || $category == "" || $product_desc == "" || $price == "" || $type == "") {
            $alert = "<span class='error'>Không được bỏ trống các trường</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // Check image size and format
                if ($file_size > 20480000) { // 20MB (20 * 1024 * 1024)
                    $alert = "<span class='error'>Ảnh nhỏ hơn 20MB</span>";
                    return $alert;
                } elseif (!in_array($file_ext, $permited)) {
                    $alert = "<span class='error'>Bạn chỉ được upload ảnh " . implode(', ', $permited) . "</span>";
                    return $alert;
                }

                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET
                    productName = '$productName', 
                    quantity = '$quantity',
                    catId = '$category',
                    type = '$type',
                    price = '$price',
                    image = '$unique_image',
                    product_desc = '$product_desc'
                    WHERE productId = '$id'";

                $result = $this->db->update($query);
                if ($result) {
                    $alert = "<span class='success'>Cập nhật thành công</span>";
                } else {
                    $alert = "<span class='error'>Cập nhật không thành công</span>";
                    return $alert;
                }
            } else {
                $query = "UPDATE tbl_product SET
                    productName = '$productName', 
                    quantity = '$quantity',
                    catId = '$category',
                    type = '$type',
                    price = '$price',
                    product_desc = '$product_desc'
                    WHERE productId = '$id'";

                $result = $this->db->update($query);
                if ($result) {
                    $alert = "<span class='success'>Cập nhật thành công</span>";
                } else {
                    $alert = "<span class='error'>Cập nhật không thành công</span>";
                    return $alert;
                }
            }
        }
    }

    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class ='success'> Xóa thành công</span> ";
            return $alert;
        } else {
            $alert = "<span class ='success'> Xóa không thành công </span> ";
            return $alert;
        }
    }

    public function getproduct_feathered()
    {
        // $query = "SELECT * FROM tbl_product WHERE type = '0' LIMIT 4 ";
        // $result = $this->db->select($query);
        // return $result;


        $sp_tungtrang = 4;
        $trang = isset($_GET['trang']) ? (int) $_GET['trang'] : 1;

        if ($trang < 1) {
            $trang = 1;
        }

        $tung_trang = ($trang - 1) * $sp_tungtrang;
        $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT $tung_trang, $sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproduct_new()
    {
        $sp_tungtrang = 4;
        $trang = isset($_GET['trang']) ? (int) $_GET['trang'] : 1;

        if ($trang < 1) {
            $trang = 1;
        }

        $tung_trang = ($trang - 1) * $sp_tungtrang;
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang, $sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }


    public function get_all_product()
    {
        $query = "SELECT * FROM tbl_product ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_details($id)
    {
        $query = "SELECT tbl_product.*, tbl_category.catName 
        FROM tbl_product, tbl_category 
        WHERE tbl_category.catId = tbl_product.catId AND tbl_product.productId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastestOne()
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '1' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestTwo()
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '2' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestThree()
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '3' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestFour()
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '4' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function search_product($tukhoa)
    {
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }

    public function search_product_admin($tukhoa){
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT tbl_product.*, tbl_category.catName FROM tbl_product, tbl_category WHERE tbl_category.catId = tbl_product.catId AND tbl_product.productName LIKE  '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }

}
?>