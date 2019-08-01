<?php
    class Model{
        public $dsn = "mysql:host=localhost; port=3306; dbname=ecomm";
        public $username = 'root';
        public $pwd = '';
        // protected $dsn = "mysql:host=198.91.81.2; port=3306; dbname=floresx6_ecomm";
        // public $username = 'floresx6_flores';
        // public $pwd = 'flores012799';
        public $db;

        public function __construct(){
            $this->db = new PDO($this->dsn, $this->username, $this->pwd, array(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            ));
        }

        function getProduct(){
            $stmt = $this->db->prepare("SELECT * FROM product_tbl");
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        function insertProduct($data){
            $stmt = $this->db->prepare("INSERT INTO product_tbl (product_name, product_desc, product_price, product_qty, product_img) 
            VALUES(:product_name, :product_desc, :product_price, :product_qty, :product_img)");
            $res = $stmt->execute(array(
                ':product_name' => $data['product_name'],
                ':product_desc' => $data['product_desc'],
                ':product_price' => $data['product_price'],
                ':product_qty' => $data['product_qty'],
                ':product_img' => $data['product_img']
            ));

            return $res;

        }

        function createAccount($data){
            $stmt = $this->db->prepare("INSERT INTO user_tbl (user_type, user_name, user_pass) VALUES(:user_type, :user_name, :user_pass)");
            $res = $stmt->execute(array(
                ':user_type' => 1,
                ':user_name' => $data['user_name'],
                ':user_pass' => $data['user_pass']
            ));

            return $res;

        }

        function login($data){
            $stmt = $this->db->prepare("SELECT a.id, a.user_name, a.user_cart FROM user_tbl a WHERE a.user_name = :user_name AND a.user_pass = :user_pass");
            $stmt->execute(array(
                ':user_name' => $data['user_name'],
                ':user_pass' => $data['user_pass']
            ));

            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            return $res;

        }

        function addToCart($data){
            $stmt = $this->db->prepare("UPDATE user_tbl SET user_cart = :cart_item WHERE id = :user_id");
            $res = $stmt->execute(array(
                ':cart_item' => $data['item'],
                ':user_id' => $data['id']
            ));

            return $res;

        }

        function adminLogin($data){
            $stmt = $this->db->prepare("SELECT * FROM user_tbl where user_name = :user_name and user_pass = :user_pass");
            $stmt->execute(array(
                ':user_name' => $data['userName'],
                ':user_pass' => $data['userPass']
            ));
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        
        function getProductT(){
            $stmt = $this->db->prepare("SELECT * FROM product_tbl");
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        function auth($auth_id){
            $stmt = $this->db->prepare("SELECT a.user_name, a.user_cpno, a.user_fname, a.user_lname, a.user_dob, 
                a.user_gender, b.address_id, b.user_city, b.user_street, b.user_barangay, b.user_city, b.user_cpno_a, b.user_fname_a, 
                b.user_lname_a FROM user_tbl a 
                LEFT JOIN user_info_tbl b on a.id = b.user_id where a.id = :auth_id ORDER BY b.id");
            $stmt->execute(array(
                ':auth_id' => $auth_id
            ));

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $res;
        }

        function adminAuth($admin_authid){
            $admin = 1;

            $stmt = $this->db->prepare("SELECT user_name FROM user_tbl where id = :a_auth_id and user_type = :user_type");
            $stmt->execute(array(
                ':a_auth_id' => $admin_authid,
                ':user_type' => $admin
            ));

            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            return $res;
        }

        function addAddress($data){
            $stmt = $this->db->prepare("INSERT INTO user_info_tbl (user_id, user_city, user_street, user_barangay, user_cpno_a, user_fname_a, user_lname_a, address_id) 
            VALUES(:id, :user_city, :user_street, :user_barangay, :user_cpno_a, :user_fname_a, :user_lname_a, :address_id)");
            $res = $stmt->execute(array(
                ':address_id' => $data['address_id'],
                ':id' => $data['id'],
                ':user_city' => $data['city'],
                ':user_street' => $data['street'],
                ':user_barangay' => $data['barangay'],
                ':user_cpno_a' => $data['phone'],
                ':user_fname_a' => $data['fname'],
                ':user_lname_a' => $data['lname']
            ));
            
            return $res;
        }

        function deleteAddress($id){
            $stmt = $this->db->prepare("DELETE FROM user_info_tbl where address_id = :address_id");
            $res = $stmt->execute(array(
                ':address_id' => $id
            ));

            return $res;
        }

        function updateAddress($data){
            $stmt = $this->db->prepare("UPDATE user_info_tbl set user_city = :user_city, user_street = :user_street,
            user_barangay = :user_barangay, user_cpno_a = :user_cpno_a, user_fname_a = :user_fname_a, user_lname_a = :user_lname_a
            WHERE address_id = :address_id");
            $res = $stmt->execute(array(
                ':address_id' => $data['address_id'],
                ':user_lname_a' => $data['user_lname_a'],
                ':user_fname_a' => $data['user_fname_a'],
                ':user_cpno_a' => $data['user_cpno_a'],
                ':user_barangay' => $data['user_barangay'],
                ':user_city' => $data['user_city'],
                ':user_street' => $data['user_street']
            ));

            return $res;
        }

        function updateOverview($id, $data){
            $stmt = $this->db->prepare("UPDATE user_tbl set user_fname = :user_fname, user_lname = :user_lname, user_cpno = :user_cpno,
            user_dob = :user_dob, user_gender = :user_gender WHERE id = :id");
            $res = $stmt->execute(array(
                ':id' => $id,
                ':user_fname' => $data['f_name'],
                ':user_lname' => $data['l_name'],
                ':user_dob' => $data['dob'],
                ':user_cpno' => $data['cpno'],
                ':user_gender' => $data['gender'],
            ));

            return $res;
        }

    }
?>