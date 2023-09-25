<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/fomat.php');
?>

<?php
class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customers($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);
        if ($name == "" || $city == "" || $address == "" || $phone == "" || $password == "") {
            $alert = "<span class='error'>Không được bỏ trống các trường</span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = "<span class 'error'> Email đã tồn tại </span> ";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer(name,city,email,address,phone,password) VALUE('$name','$city','$email','$address','$phone','$password') ";
                $result = $this->db->insert($query);
                // true pass, user
                if ($result) {
                    $alert = "<span class ='success'>Tạo tài khoản thành công</span> ";
                    return $alert;
                } else {
                    $alert = "<span class ='success'>Tạo tài khoản không thành công</span> ";
                    return $alert;
                }
            }
        }

    }
    public function login_customers($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);
        if ($email == '' || $password == '') {
            $alert = "<span class='error'>Email và Password không được bỏ trống </span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password' LIMIT 1";
            $result_check = $this->db->select($check_login);
            if ($result_check != false) {
                // creat session
                $value = $result_check->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                header('Location:order.php');
            } else {
                $alert = "<span class = 'error'> Email hoặc password không đúng  </span> ";
                return $alert;
            }
        }

    }

    public function get_all_product_customer_ordered()
    {
        $query = "SELECT * FROM tbl_customer  ";
        $get_ordered = $this->db->select($query);
        return $get_ordered;
    }
    public function customer_shows($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id' ";
        $result_query = $this->db->select($query);
        return $result_query;
    }
    public function search_customer($tukhoa){
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_customer WHERE name LIKE '%$tukhoa%' ";
        $result_query = $this->db->select($query);
        return $result_query;
    }
    public function show_order($order_code){
        $query = "SELECT * FROM tbl_order WHERE order_code = '$order_code' ";
        $result_query = $this->db->select($query);
        return $result_query;
    }

    public function customer_show_all()
    {
        $query = "SELECT * FROM tbl_customer, tbl_order WHERE tbl_customer.id = tbl_order.customer_id  ";
        $result_query = $this->db->select($query);
        return $result_query;
    }

    public function update_customers($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        if ($name == "" || $city == "" || $email == "" || $address == "" || $phone == "") {
            $alert = "<span class='error'>Không được bỏ trống các trường</span>";
            return $alert;
        } else {

            $query = "UPDATE tbl_customer SET name ='$name' ,city = '$city',email = '$email', address = '$address', phone = '$phone' WHERE id = '$id' ";
            $result = $this->db->update($query);
            // true pass, user
            if ($result) {
                $alert = "<span class ='success'>Cập nhật thành công</span> ";
                return $alert;
            } else {
                $alert = "<span class ='success'>Cập nhật không thành công</span> ";
                return $alert;
            }
        }

    }
}
?>