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

                    $product = json_decode($res['user_cart']);

                    // foreach($res as $item){
                    //     array_push($product, array(
                    //         'qty' => $item['qty'],
                    //         'product_name' => $item['product_name'],
                    //         'product_desc' => $item['product_desc'],
                    //         'product_price' => $item['product_price'],
                    //         'product_qty' => $item['product_qty']
                    //     ));
                    // }

                    $user_log = array(
                        'id' => $auth_id,
                        'user_name' => $res['user_name'],
                        'cart' => $product
                    );

                    if($user_log['user_name'] == '' || null){
                        return false;
                    }

                    return $user_log;
                }
            }

        }

        function addToCartC($new_item, $prev_item, $qty){
            $prev_item_dec = json_decode($prev_item, true);
            $id_e = $_COOKIE['auth'];
            $id = $this->encript_decrypt($id_e, 'decr');
            $in_item = 0;

            if($new_item['product_qty'] >= $qty){

                function creating_item($new_item, $qty){
                    $new_item = array(
                        0 => array(
                            'id' =>  $new_item['id'],
                            'product_name' => $new_item['product_name'],
                            'product_desc' => $new_item['product_desc'],
                            'product_price' => $new_item['product_price'],
                            'product_img' => $new_item['product_img'],
                            'qty' => $qty
                        )
                    );

                    return $new_item;

                }

                if(empty($prev_item_dec) || $prev_item_dec == '' || null){
                    $new_cart = creating_item($new_item, $qty);
                    $data_item = array(
                        'item' => json_encode($new_cart),
                        'id' => $id
                    );
                    $result = array(
                        'status' => $this->addToCart($data_item),
                        'new_cart' => $new_cart
                    );

                    return $result;
        
                }


                for($i = 0; $i < sizeof($prev_item_dec); $i++){

                    if($new_item['id'] == $prev_item_dec[$i]['id']){
                        $item_qty = $new_item['product_qty'];
                        $new_qty = $prev_item_dec[$i]['qty'] + $qty;
                        if((int)$item_qty >= (int)$new_qty){
                            $prev_item_dec[$i]['qty'] = $new_qty;
                            $in_item = 1;
                        }else{
                            $result = array(
                                'status' => false
                            );
                            return $result;
                        }

                    }

                }
                if($in_item == 1){
                    $new_cart = $prev_item_dec;
                    $data_item = array(
                        'item' => json_encode($prev_item_dec),
                        'id' => $id
                    );
                }else{
                
                    $new_cart = array_merge(creating_item($new_item, $qty), $prev_item_dec);
                    $data_item = array(
                        'item' => json_encode($new_cart),
                        'id' => $id
                    );

                }

                $result = array(
                    'status' => $this->addToCart($data_item),
                    'new_cart' => $new_cart
                );

                return $result;

            }else{
                $result = array(
                    'status' => false,
                    'new_cart' => null
                );

                return $result;
            }

            // return $prev_item[0];
           
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

        function addAddressC($data){
            $fname = (isset($data['user_fname_a']) ? $data['user_fname_a'] : '');

            $lname = (isset($data['user_lname_a']) ? $data['user_lname_a'] : '');

            $phone = (isset($data['user_cpno_a']) ? $data['user_cpno_a'] : '');

            $street = (isset($data['user_street']) ? $data['user_street'] : '');

            $barangay = (isset($data['user_barangay']) ? $data['user_barangay'] : '');

            $city = (isset($data['user_city']) ? $data['user_city'] : '');

            $address_id = (isset($data['address_id']) ? $data['address_id'] : '');

            if(isset($_COOKIE['auth'])){
                $id = $this->encript_decrypt($_COOKIE['auth'], 'decr');

                if($id != false){
                    $data = array(
                        'address_id' => $address_id,
                        'id' => $id,
                        'fname' => $fname,
                        'lname' => $lname,
                        'phone' => $phone,
                        'street' => $street,
                        'barangay' => $barangay,
                        'city' => $city,
                    );
    
                    $res = array(
                        'status' => true,
                        'add' => $this->addAddress($data)
                    );
    
                    return $res;
                }

            }

            $error = array(
                'status' => false
            );

            return $error;

        }

        function deleteAddressC($data){
            $error = array(
                'status' => false
            );

            if(isset($_COOKIE['auth'])){
                $authid = $_COOKIE['auth'];
                $auth = $this->encript_decrypt($authid, 'decr');

                if($auth != false){

                    $id = (isset($data) ? $data : '');
                    if($id == ''){
                        return $error;
                    }
                    $this->deleteAddress($id);
                    $error = array(
                        'status' => true,
                        'delete' => $this->deleteAddress($id)
                    );

                    return $error;

                }
            }

            return $error;
        }

        function updateAddressC($data){
            $address_id = (isset($data['address_id']) ? $data['address_id'] : '');
            $user_fname_a = (isset($data['user_fname_a']) ? $data['user_fname_a'] : '');
            $user_lname_a = (isset($data['user_lname_a']) ? $data['user_lname_a'] : '');
            $user_cpno_a = (isset($data['user_cpno_a']) ? $data['user_cpno_a'] : '');
            $user_street = (isset($data['user_street']) ? $data['user_street'] : '');
            $user_barangay = (isset($data['user_barangay']) ? $data['user_barangay'] : '');
            $user_city = (isset($data['user_city']) ? $data['user_city'] : '');

            $data = array(
                'address_id' => $address_id,
                'user_fname_a' => $user_fname_a,
                'user_lname_a' => $user_lname_a,
                'user_cpno_a' => $user_cpno_a,
                'user_street' => $user_street,
                'user_barangay' => $user_barangay,
                'user_city' => $user_city
            );

            if(isset($_COOKIE['auth'])){
                $authid = $_COOKIE['auth'];
                $auth = $this->encript_decrypt($authid, 'decr');

                if($auth != false){
                    $res = array(
                        'status' => true,
                        'update' => $this->updateAddress($data)
                    );
    
                    return $res;
                }

                $error = array(
                    'status' => false
                );

                return $error;

            }

        }

        function updateOverviewC($data){
            $f_name = (isset($data['fName']) ? $data['fName'] : '');
            $l_name = (isset($data['lName']) ? $data['lName'] : '');
            $dob = (isset($data['dob']) ? $data['dob'] : '');
            $cpno = (isset($data['cpno']) ? $data['cpno'] : '');
            $gender = (isset($data['gender']) ? $data['gender'] : '');

            $data = array(
                'f_name' => $f_name,
                'l_name' => $l_name,
                'dob' => $dob,
                'cpno' => $cpno,
                'gender' => $gender,
            );

            if(isset($_COOKIE['auth'])){
                $id = $_COOKIE['auth'];
                $id = $this->encript_decrypt($id, 'decr');

                if($id != false){
                    $res = array(
                        'update' => true,
                        'status' => $this->updateOverview($id, $data)
                    );
    
                    return $res;
                }

            }

            $error = array(
                'update' => false
            );

            return $error;
        }

    }
    // End

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
        echo json_encode($obj->addToCartC($_POST['item'], $_POST['prevItem'], $_POST['qty']));
    }

    if(isset($_POST['adminLogin'])){
        echo json_encode($obj->adminLoginC($_POST['adminLogData']));
    }

    if(isset($_GET['getProductTable'])){
        echo json_encode($obj->getProductTC());
    }
    
    if(isset($_GET['getCart'])){
        if(isset($_COOKIE['auth'])){
            $auth_id = $_COOKIE['auth'];
            $obj->getCartC($auth_id);
        }
    }

    if(isset($_POST['addAddress'])){
        echo json_encode($obj->addAddressC($_POST['addresInfo']));
    }

    if(isset($_POST['deleteAddress'])){
        echo json_encode($obj->deleteAddressC($_POST['id']));
    }

    if(isset($_POST['updateAddress'])){
        echo json_encode($obj->updateAddressC($_POST['newAddress']));
    }

    if(isset($_POST['updateOverview'])){
        echo json_encode($obj->updateOverviewC($_POST['overview']));
    }

?>