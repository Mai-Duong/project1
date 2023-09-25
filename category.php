<?php
// include '../lib/database.php';
// include '../helpers/fomat.php';
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/fomat.php');
?>

<?php
class category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $alert = "<span class ='error'>Insert must be not empty</span> ";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUE('$catName') ";
            $result = $this->db->insert($query);
            // true pass, user
            if ($result) {
                $alert = "<span class ='success'>Thêm danh mục thành công</span> ";
                return $alert;
            } else {
                $alert = "<span class ='success'>Thêm danh mục không thành công</span> ";
                return $alert;
            }
        }
    }

    public function show_category()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId desc ";
        $result = $this->db->select($query);
        return $result;
    }

    public function search_cat($tukhoa)
    {
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_category WHERE catName LIKE '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($catName, $id)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($catName)) {
            $alert = "<span class ='error'>Dữ liệu không được trống</span> ";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id' ";
            $result = $this->db->update($query);
            // true pass, user
            if ($result) {
                $alert = "<span class ='success'> Cập nhật danh mục thành công</span> ";
                return $alert;
            } else {
                $alert = "<span class ='success'>Cập nhật danh mục không thành công</span> ";
                return $alert;
            }
        }
    }
    public function getcatbyId($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_category($id)
    {
        $query = "DELETE FROM tbl_category WHERE catId = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class ='success'> Xóa danh mục thành công</span> ";
            return $alert;
        } else {
            $alert = "<span class ='success'> Xóa danh mục không thành công </span> ";
            return $alert;
        }
    }
    public function get_product_by_cat($id)
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '$id'  ORDER BY catId desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_name_by_cat($id)
    {
        $query = "SELECT * FROM tbl_product, tbl_category WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}
?>