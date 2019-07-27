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
            $stmt = $this->db->prepare("SELECT user_tbl.id, user_name, product_id, COUNT(user_cart.id) cart_count FROM user_tbl LEFT JOIN user_cart 
                ON user_tbl.id = user_cart.user_id WHERE user_tbl.user_name = :user_name 
                AND user_tbl.user_pass = :user_pass");
            $stmt->execute(array(
                ':user_name' => $data['user_name'],
                ':user_pass' => $data['user_pass']
            ));

            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            return $res;

        }

        function addToCart($data){
            $stmt = $this->db->prepare("INSERT INTO user_cart (product_id, user_id, qty) VALUES(:product_id, :user_id, :qty)");
            $res = $stmt->execute(array(
                ':product_id' => $data['item']['id'],
                ':user_id' => $data['id'],
                ':qty' => $data['qty']
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
            $stmt = $this->db->prepare("SELECT a.user_name, COUNT(b.id) cart_count FROM user_tbl a LEFT JOIN user_cart b ON a.id = b.user_id WHERE a.id = :auth_id");
            $stmt->execute(array(
                ':auth_id' => $auth_id
            ));

            $res = $stmt->fetch(PDO::FETCH_ASSOC);

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

    }
?>