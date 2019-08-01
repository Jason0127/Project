<?php
    ob_start();

    $addresses = (isset($_GET['userAddress']) ? $_GET['userAddress'] : '');
    // echo json_encode($addresses);


    function set_capital($data){
        if($data == '' || empty($data)){
            return '';
        }
        return strtoupper($data[0]) . ltrim($data, $data[0]);
    }

    function set_name($fname, $lname){
        if ($fname == '' && $lname == ''){
            return '';
        }
        return set_capital($lname) . ',' . ' ' . set_capital($fname);
    }

    function set_street($data){
        $stretstr = 'street';
        if(empty($data) || $data == ''){
            return '';
        }
        if(strpos(strtolower($data), $stretstr) === true){
            return set_capital(ltrim($data, 'street')) . ' ' . set_capital($stretstr);
        }
        return set_capital($data) . ' ' . set_capital($stretstr);
    }

    function set_city($data){
        $strcity = 'city';
        if(empty($data) || $data == ''){
            return '';
        }
        if(strpos(strtolower($data), $strcity) == true){
            return set_capital(ltrim($data), '$strcity') . ' ' . set_capital($strcity);
        }
        return set_capital($data) . ' ' . set_capital($strcity);
    }

?>

<div class="profile-address card hidee">
    <h3 class="text-center mt-4">My Address</h3>
    <div class="d-flex justify-content-end">
        <button class="btn btn-md my-btn-color" data-toggle="modal"data-target="#add-address-modal">
            <i class="fas fa-plus mr-2"></i>
            Add Address
        </button>
    </div>
    <hr class="mb-0">
    <div class="row">
        <?php
            if(!empty($addresses)){
                foreach($addresses as $address){
        ?>          <div class="col-md-12 d-flex addres-item ml-4 mlxsm">
                        <div class="d-dlex w-75 mb-4 mw-sm">
                            <div class="address-bar mt-4">
                                <div class="d-inline-block mr-4 grey-text">
                                    Name
                                </div>
                                <div class="d-inline-block">
                                    <span><?= set_name($address['user_fname_a'], $address['user_lname_a'])?></span>
                                </div>
                            </div>
                            <div class="address-bar mt-2">
                                <div class="d-inline-block mr-4 grey-text">
                                    Phone
                                </div>
                                <div class="d-inline-block">
                                    <span><?= $address['user_cpno_a']?></span>
                                </div>
                            </div>
                            <div class="address-bar mt-2">
                                <div class="d-inline-block mr-4 grey-text">
                                    Adress
                                </div>
                                <div class="d-inline-block">
                                    <span><?= set_street($address['user_street'])?> <br /><?= $address['user_barangay']?> <?= set_city($address['user_city'])?></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-25 align-items-center">
                            <a onclick="UpdateAddress(<?= $address['address_id']?>)">Edit</a>
                            <a class="ml-3" data-id="<?= $address['address_id']?>" onclick="Delete(<?= $address['address_id']?>)">Delete</a>
                        </div>
                    </div>    
<?php           }
            }?>
    </div>
</div>

<?php
    $set = ob_get_clean();

    echo $set;
?>