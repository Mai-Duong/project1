<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/fomat.php');
?>



<?php
class cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // public function add_to_cart($quantity_cart, $id)
    // {

    // $quantity_cart = $this->fm->validation($quantity_cart);
    // $quantity_cart = mysqli_real_escape_string($this->db->link, $quantity_cart);

    // //session
    // $id = mysqli_real_escape_string($this->db->link, $id);
    // $sId = session_id();

    // $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
    // $result = $this->db->select($query)->fetch_assoc();

    // // echo '<pre>';
    // // echo print_r($result);
    // // echo '</pre>';

    // $image = $result["image"];
    // $price = $result["price"];
    // $productName = $result["productName"];

    // $check_query = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId' ";
    // $check_cart = $this->db->select($check_query);

    // if ($check_cart) {
    //     $msg = "Product Already Added";
    //     return $msg;
    // } else {
    //     $query_insert = "INSERT INTO tbl_cart (productId, quantity_cart, sId, image, price, productName) VALUES ('$id', '$quantity_cart', '$sId', '$image', '$price', '$productName')";
    //     $insert_cart = $this->db->insert($query_insert);

    //     if ($insert_cart) {
    //         header('Location: cart.php');
    //         exit(); // Đảm bảo kết thúc việc thực thi sau khi thực hiện chuyển hướng
    //     } else {
    //         header('Location: 404.php');
    //         exit(); // Tương tự, đảm bảo kết thúc việc thực thi sau khi thực hiện chuyển hướng
    //     }
    // }

    // }

    public function add_to_cart($quantity_cart, $quantity_stock, $id)
    {
        $quantity_cart = $this->fm->validation($quantity_cart);
        $quantity_cart = mysqli_real_escape_string($this->db->link, $quantity_cart);

        $quantity_stock = $this->fm->validation($quantity_stock);
        $quantity_stock = mysqli_real_escape_string($this->db->link, $quantity_stock);

        // Session
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result["image"];
        $price = $result["price"];
        $productName = $result["productName"];

        $check_query = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId' ";
        $check_cart = $this->db->select($check_query);

        if (!$check_cart) {
            if ($quantity_cart > $quantity_stock) {
                $msg = '<span class="error">Not enough products</span>';
                return $msg;
            } else {
                $query_insert = "INSERT INTO tbl_cart (productId, quantity_cart, sId, image, price, productName) VALUES ('$id', '$quantity_cart', '$sId', '$image', '$price', '$productName')";
                $insert_cart = $this->db->insert($query_insert);

                if ($insert_cart) {
                    header('Location: cart.php');
                    exit(); // Đảm bảo kết thúc việc thực thi sau khi thực hiện chuyển hướng
                } else {
                    header('Location: 404.php');
                    exit(); // Tương tự, đảm bảo kết thúc việc thực thi sau khi thực hiện chuyển hướng
                }
            }
        } else {
            $msg = "Product Already Added";
            return $msg;
        }
    }


    // public function add_to_cart($quantity_cart, $quantity_stock, $id)
    // {
    //     $quantity_cart = $this->fm->validation($quantity_cart);
    //     $quantity_cart = mysqli_real_escape_string($this->db->link, $quantity_cart);

    //     $quantity_stock = $this->fm->validation($quantity_stock);
    //     $quantity_stock = mysqli_real_escape_string($this->db->link, $quantity_stock);

    //     // Session
    //     $id = mysqli_real_escape_string($this->db->link, $id);
    //     $sId = session_id();
    //     $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId' ";
    //     $result_check_cart = $this->db->select($check_cart);

    //     if ($quantity_cart <= $quantity_stock) {
    //         if ($result_check_cart) {
    //             $msg = "Product Ordered";
    //             return $msg;
    //         } else {
    //             $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
    //             $result = $this->db->select($query)->fetch_assoc();

    //             $image = $result["image"];
    //             $price = $result["price"];
    //             $productName = $result["productName"];

    //             $query_insert = "INSERT INTO tbl_cart (productId, quantity_cart, sId, image, price, productName) VALUES ('$id', '$quantity_cart', '$sId', '$image', '$price', '$productName')";
    //             $insert_cart = $this->db->insert($query_insert);

    //             if ($insert_cart) {
    //                 $msg = "Product Already Added";
    //                 return $msg;
    //             }
    //         }
    //     } else {
    //         $msg = '<span class="error">Not enough products</span>';
    //         return $msg;
    //     }
    // }



    public function get_product_cart()
    {

        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_quantity_cart($quantity_cart, $cartId)
    {

        $quantity_cart = mysqli_real_escape_string($this->db->link, $quantity_cart);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);

        $query = "UPDATE tbl_cart SET quantity_cart = '$quantity_cart' WHERE cartId = '$cartId' ";
        $result = $this->db->update($query);
        if ($result) {
            // header('Location:cart.php');
            $msg = "<span class = 'error' >Cập nhật giỏ hàng thành công</span>";
            return $msg;
        } else {
            $msg = "<span class = 'error' >Cật nhật giỏ hàng không thành công</span>";
            return $msg;
        }
    }

    public function del_product_cart($cartid)
    {
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartid' ";
        $result = $this->db->delete($query);
        if ($result) {
            header('Location:cart.php');
        } else {
            $msg = "<span class = 'error' >Product Quantity Delete Not Succesfullly</span>";
            return $msg;
        }
    }

    public function check_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
        $result = $this->db->select($query);
        return $result;

    }
    public function check_order($customner_id)
    {
        // $sId = session_id();
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customner_id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_all_data_cart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId' ";
        $result = $this->db->select($query);
        return $result;
    }

    // public function insertOrder($customer_idd)
    // {
    //     $sId = session_id();
    //     $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
    //     $get_product = $this->db->select($query);

    //     $order_code = rand(0000,9999);
    //     $query_placed = "INSERT INTO tbl_placed(customer_id,order_code,status) VALUES('$customer_idd','$order_code','0') ";
    //     $insert_placed = $this->db->insert($query_placed);

    //     if ($get_product) {
    //         while ($result = $get_product->fetch_assoc()) {
    //             $productId = $result['productId'];
    //             $productName = $result['productName'];
    //             $quantity = $result['quantity_cart'];
    //             $price = $result['price'] * $quantity;
    //             $image = $result['image'];
    //             $customer_id = $customer_idd;
    //             // 
    //             // $query_customer = "SELECT * FROM tbl_customer WHERE id = '$customer_id' ";
    //             // $result = $this->db->select($query_customer);
    //             // if ($result) {
    //                 $query_order = "INSERT INTO tbl_order(order_code,productId, productName, quantity, price, image,customer_id) VALUES ('$order_code','$productId', '$productName','$quantity', '$price', '$image','$customer_id')";
    //                 $insert_order = $this->db->insert($query_order);
    //                 // return $insert_order;
    //             // } 

    //         }
    //     }
    // }

    public function insertOrder($customer_idd)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
        $get_product = $this->db->select($query);

        $order_code = rand(0000, 9999);
        $query_placed = "INSERT INTO tbl_placed(customer_id, order_code, status) VALUES ('$customer_idd', '$order_code', '0') ";
        $insert_placed = $this->db->insert($query_placed);

        $inserted_orders = array(); // Tạo một mảng để lưu trữ các kết quả của INSERT

        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity_cart'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $customer_id = $customer_idd;

                $query_order = "INSERT INTO tbl_order(order_code, productId, productName, quantity, price, image, customer_id) VALUES ('$order_code', '$productId', '$productName', '$quantity', '$price', '$image', '$customer_id')";
                $insert_order = $this->db->insert($query_order);

                // Thêm kết quả của INSERT vào mảng
                $inserted_orders[] = $insert_order;
            }
        }

        // Trả về mảng chứa kết quả của tất cả các INSERT
        return $inserted_orders;
    }


    public function checkCustomerExistence($customer_id)
    {
        $query_customer = "SELECT * FROM tbl_customer WHERE id = '$customer_id' ";
        $result = $this->db->select($query_customer);
        return $result;
    }



    public function getAmountPrice($customer_id)
    {
        $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id' ";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    public function get_cart_ordered($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' AND status = 1 ";
        $get_ordered = $this->db->select($query);
        return $get_ordered;
    }



    public function get_cart_order_of_customer($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'  ";
        $get_ordered = $this->db->select($query);
        return $get_ordered;
    }

    public function get_cart_ordered_all($customer_id)
    {
        // $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'  ";
        // $query = "SELECT tbl_order.productName,tbl_order.image,tbl_order.customer_id, tbl_order.price, tbl_order.quantity, tbl_order.date_order, tbl_placed.status FROM tbl_order, tbl_placed WHERE tbl_order.order_code = tbl_placed.order_code AND tbl_placed.status AND tbl_order.customer_id = '$customer_id'  ";
        $query = "SELECT tbl_order.productName,tbl_order.image,tbl_order.customer_id, tbl_order.price, tbl_order.quantity, tbl_order.date_order, tbl_placed.status FROM tbl_order,tbl_customer, tbl_placed WHERE tbl_order.customer_id = tbl_customer.id AND tbl_order.order_code = tbl_placed.order_code AND tbl_customer.id = '$customer_id' ";

        $get_ordered = $this->db->select($query);
        return $get_ordered;
    }

    public function indonhang($id)
    {
        // $indon = "SELECT * FROM tbl_order WHERE customer_id = '$id' AND status = 0 ";
        $indon = "SELECT * FROM tbl_order, tbl_placed WHERE tbl_order.order_code = tbl_placed.order_code AND tbl_order.customer_id = '$id' AND tbl_placed.status = 0 ";
        $get_ordered = $this->db->select($indon);
        return $get_ordered;
    }

    public function search_customer($tukhoa)
    {
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_customer WHERE id LIKE '%$tukhoa%' ";
        $result_query = $this->db->select($query);
        return $result_query;
    }
    public function get_all_product_customer_ordered()
    {
        $query = "SELECT * FROM tbl_customer  ";
        $get_ordered = $this->db->select($query);
        return $get_ordered;
    }

    public function search_inbox($tukhoa)
    {
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_placed, tbl_customer WHERE tbl_placed.customer_id = tbl_customer.id AND tbl_customer.name LIKE '%$tukhoa%' ORDER BY date_created   ";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }

    public function get_inbox_cart()
    {
        // $query = "SELECT * FROM tbl_placed, tbl_customer,tbl_order WHERE tbl_placed.customer_id = tbl_customer.id AND tbl_order.order_code = tbl_placed.order_code  ORDER BY date_created ";
        $query = "SELECT * FROM tbl_placed, tbl_customer WHERE tbl_placed.customer_id = tbl_customer.id   ORDER BY date_created ";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }


    public function get_inbox_cart_history($customer_id)
    {
        // $query = "SELECT * FROM tbl_placed, tbl_customer,tbl_order WHERE tbl_placed.customer_id = tbl_customer.id AND tbl_order.order_code = tbl_placed.order_code  ORDER BY date_created ";
        $query = "SELECT * FROM tbl_placed, tbl_customer WHERE tbl_placed.customer_id = tbl_customer.id AND tbl_customer.id = '$customer_id'  ORDER BY date_created ";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }

    public function shifted($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tbl_placed SET status = '1' WHERE order_code = '$id' ";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'>Đơn hàng đã được xử lý</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Đơn hàng chưa được xử lý</span>";
            return $msg;
        }
    }
    public function confirm_received($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tbl_placed SET status = '2' WHERE order_code = '$id' ";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'>Đơn hàng đã được xử lý</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Đơn hàng chưa được xử lý</span>";
            return $msg;
        }
    }
    public function del_shifted($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM tbl_placed WHERE order_code = '$id' ";
        $result = $this->db->delete($query);

        if ($result) {
            $msg = "<span class='success'>Xóa đơn hàng thành công</span>";
        } else {
            $msg = "<span class='error'>Xóa đơn hàng không thành công</span>";
        }

        return $msg;
    }


    public function shirfed_cormfim($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tbl_order SET status = '2' WHERE customer_id = '$id'";
        $result = $this->db->update($query);
        return $result;

    }
}
?>