<?php
// include '../lib/database.php';
// include '../helpers/fomat.php';
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/fomat.php');
?>

<?php
class contact
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getContactInfo()
    {
        $query = "SELECT * FROM tbl_contact WHERE id = 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_contact($data){
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $transport = mysqli_real_escape_string($this->db->link, $data['transport']);
        $note = mysqli_real_escape_string($this->db->link, $data['note']);
        if ($transport == "" || $note == "" || $email == "" || $address == "" || $phone == "") {
            $alert = "<span class='error'>Không được bỏ trống các trường</span>";
            return $alert;
        } else {

            $query = "UPDATE tbl_contact SET phone ='$phone' ,address = '$address',email = '$email', transport = '$transport', note = '$note' WHERE id = 1 ";
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