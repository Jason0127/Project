<?php
    include_once './controller.php';

    $errors = array(
        'status' => false
    );

    if(isset($_GET['auth'])){
        if(isset($_COOKIE['auth'])){

            $auth = $_COOKIE['auth'];

            $id = $obj->encript_decrypt($auth, 'decr');

            $res = $obj->auth($id);

            if($res == false){
               
                echo json_encode($errors);
            }else{
                if($res['user_name'] != null || ''){
                    echo json_encode($res);
                }else{
                    echo json_encode($errors);
                }
            }

        }else {
            echo json_encode($errors);
        }
    }

    if(isset($_GET['authAdmin'])){
        if(isset($_COOKIE['adminAuth'])){
            $auth_admin = $_COOKIE['adminAuth'];

            $admin_id = $obj->encript_decrypt($auth_admin, 'decr');

            $res = $obj->adminAuth($admin_id);

            if($res == false){

                echo json_encode($errors);
            }else{
                echo json_encode($res);
            }
        }else{
            echo json_encode($errors);
        }
    }
?>