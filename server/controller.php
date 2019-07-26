<?php 

    include_once './model.php';
    class Controller extends Model{
        public function __construct(){
            parent::__construct();
        }

        function getProductC(){
            return $this->getProduct();
        }

        function insertProductC($data){
            $product_name = (isset($data['productName'])) ? $data['productName'] : '';
            $product_desc = (isset($data['productDesc'])) ? $data['productDesc'] : '';
            $product_price = (isset($data['productPrice'])) ? $data['productPrice'] : '';
            $product_qty = (isset($data['productQty'])) ? $data['productQty'] : '';
            $product_img = (isset($data['productImg'])) ? $data['productImg'] : '';

            $item = array(
                'product_name' => $product_name,
                'product_desc' => $product_desc,
                'product_price' => $product_price,
                'product_qty' => $product_qty,
                'product_img' => $product_img
            );

            return $this->insertProduct($item);
        }

        function createAccountC($data){

            $user_name = (isset($data['userName']) ? $data['userName'] : '');
            $user_pass = (isset($data['userPass']) ? $data['userPass'] : '');
            $user_repass = (isset($data['userRePass']) ? $data['userRePass'] : '');

            if($user_pass == '' || $user_name == ''){
                return 'asdasd';
            }else{
                if($user_pass == $user_repass){
                
                    $item = array(
                        'user_name' => $user_name,
                        'user_pass' => $user_repass
                    );
    
                    return $this->createAccount($item);
                }else{
                    return false;
                }
            
            }
        }

        function encript_decrypt($id, $action){
            $secret_iv = 'secret0127';
            $secret_key = '0127';
            $method = 'AES-256-CBC';

            $key = hash('sha256', $secret_key);

            $iv = substr(hash('sha256', $secret_iv), 0, 16);

            if($action == 'encr'){
                $out = openssl_encrypt($id, $method, $key, 0, $iv);
                $out = base64_encode($out);
            }elseif($action == 'decr'){
                $out = openssl_decrypt(base64_decode($id), $method, $key, 0, $iv);
            }
            
            return $out;
        }


        function loginC($data){
            $user_name = (isset($data['email']) ? $data['email'] : '');
            $user_pass = (isset($data['pass']) ? $data['pass'] : '');

            if($user_name == '' || $user_pass ==''){
                return 0;
            }else{
                
                $logdata = array(
                    'user_name' => $user_name,
                    'user_pass' => $user_pass
                );

                $res = $this->login($logdata);

                if($res == 'false' || $res == false){
                    return false;
                }else{

                    $auth_id = $this->encript_decrypt($res['id'], 'encr');

                    setcookie('auth', $auth_id, time() + 3600, '/');

                    $user_log = array(
                        'id' => $auth_id,
                        'user_name' => $res['user_name'],
                        'cart_count' => $res['cart_count']
                    );

                    if($user_log['cart_count'] == 0 && $user_log['user_name'] == '' || null){
                        return false;
                    }

                    return $user_log;
                }
            }

        }

        function addToCartC($data, $qty){

            $id_e = $_COOKIE['auth'];

            $id = $this->encript_decrypt($id_e, 'decr');

            $data_item = array(
                'item' => $data,
                'qty' => $qty,
                'id' => $id
            );

            return $this->addToCart($data_item);
           
        }

        function adminLoginC($data){
            $res = $this->adminLogin($data);
            if(empty($res)){
                return 0;
            }elseif($res['user_type'] != 1){
                return 0;
            }else{

                $admin_auth = $this->encript_decrypt($res['id'], 'encr');

                setcookie('adminAuth', $admin_auth, time() + 1800, '/');

                return $res;
            }
        }

        function getProductTC(){
            return $this->getProductT();
        }

    }

    $obj = new Controller();

    
    if(isset($_POST['getProduct'])){
        $res = $obj->getProductC();

        echo json_encode($res);
    }

    if(isset($_POST['insertProd'])){
       echo $obj->insertProductC($_POST['data']);
        // print_r();
    }

    if(isset($_POST['create'])){
        echo $obj->createAccountC($_POST['formdata']);
    }

    if(isset($_POST['login'])){
        echo json_encode($obj->loginC($_POST['logdata']));
    }

    if(isset($_POST['cart'])){
        $id = (isset($_POST['userId']) ? $_POST['userId'] : '');
        echo $obj->addToCartC($_POST['item'], $_POST['qty']);
    }

    if(isset($_POST['adminLogin'])){
        echo json_encode($obj->adminLoginC($_POST['adminLogData']));
    }

    if(isset($_GET['getProductTable'])){
        echo json_encode($obj->getProductTC());
    }
    
?>