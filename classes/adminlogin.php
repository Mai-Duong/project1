<?php
$filepath = realpath(dirname(__FILE__));

include($filepath . '/../lib/session.php');
Session::checkLogin();
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/fomat.php');
?>

<?php
class adminlogin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($adminUser, $adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminPass) || empty($adminUser)) {
            $alert = "Không được bỏ trống các trường";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE adminUser ='$adminUser' AND adminPass = '$adminPass'";
            // $query = "SELECT * FROM tbl_admin WHERE adminUser ='mai' AND adminPass = 'mai'";
            $result = $this->db->select($query);
            // true pass, user
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('adminlogin', true);
                Session::set('adminId', $value['adminId']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminEmail', $value['adminEmail']);
                Session::set('adminName', $value['adminName']);
                header('Location:index.php');


                // $value = $result->fetch_assoc();
                // Session::set('adminlogin', true);
                // Session::set('adminId', $value['adminId']);
                // Session::set('adminUser', $value['adminUser']);
                // Session::set('adminEmail', $value['adminEmail']); // Lưu adminEmail vào phiên session
                // Session::set('adminName', $value['adminName']);
                // header('Location:index.php');
            } else {
                $alert = "Tài khoản hoặc mật khẩu không đúng";
                return $alert;
            }
        }
    }

// public function login_admin($adminUser, $adminPass)
// {
//     $adminUser = $this->fm->validation($adminUser);
//     $adminPass = $this->fm->validation($adminPass);

//     // Sử dụng prepared statement để tránh SQL Injection
//     $query = "SELECT * FROM tbl_admin WHERE adminUser = ? AND adminPass = ?";
//     $stmt = $this->db->link->prepare($query);
//     $stmt->bind_param("ss", $adminUser, $adminPass);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows === 1) {
//         $value = $result->fetch_assoc();
//         Session::set('adminlogin', true);
//         Session::set('adminId', $value['adminId']);
//         Session::set('adminUser', $value['adminUser']);
//         Session::set('adminName', $value['adminName']);
//         header('Location:index.php');
//     } else {
//         $alert = "Tài khoản hoặc mật khẩu không đúng";
//         return $alert;
//     }
// }



// public function update($id)
// {
//     // $tukhoa = $this->fm->validation($id);
//     $query = "SELECT * FROM tbl_admin WHERE adminId = '$id' ";
//     $result = $this->db->select($query);
//     return $result;
// }
}
?>