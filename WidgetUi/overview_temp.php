<?php
    ob_start();

    $user_info = (isset($_GET['user']) ? $_GET['user'] : '');

    $user_fname = (isset($user_info['user_fname']) ? $user_info['user_fname'] : '');
    $user_lname = (isset($user_info['user_lname']) ? $user_info['user_lname'] : '');
    $user_gender = (isset($user_info['user_gender']) ? $user_info['user_gender'] : '');
    $user_cpno = (isset($user_info['user_cpno']) ? $user_info['user_cpno'] : '');
    $user_dob = (isset($user_info['user_dob']) ? $user_info['user_dob'] : ''); 

    function set_capital_first_letter($data){
        if(empty($data) || $data == ''){
            return 'asd';
        }
        return strtoupper($data[0]) . ltrim($data, $data[0]);
    }

    function set_full_name($fname, $lname){
        return set_capital_first_letter($fname) . ' ' . set_capital_first_letter($lname);
    }

?>


<div class="profile card hidee">
    <div class="overview p-3">
        <div class="info-item mb-5 ml-4 mt-4">
            <div class="info-item-label d-inline-block font-weight-bolder grey-text">Full Name:</div>
            <div class="d-inline-block text-item">
                <input class="disable" type="text" id="name" value="<?= set_full_name($user_fname, $user_lname)?>">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="info-item mb-5 ml-4">
            <div class="info-item-label d-inline-block font-weight-bolder grey-text">Phone Number:</div>
            <div class="d-inline-block text-item">
                <input class="disable" type="text" id="phone_number" value="<?= $user_cpno?>">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="info-item mb-5 ml-4">
            <div class="info-item-label d-inline-block font-weight-bolder grey-text">Gender:</div>
            <select id="gender" class="disable text-item">
                <option <?= (($user_gender == '' || null) ? 'selected' : '')  ?> value="0"></option>
                <option <?= ((strtolower($user_gender) == 'male') ? 'selected' : '')?> value="male">Male</option>
                <option <?= ((strtolower($user_gender) == 'female') ? 'selected' : '')?> value="female">Female</option>
            </select>
        </div>
        <div class="info-item mb-4 ml-4">
            <div class="info-item-label d-inline-block font-weight-bolder grey-text">Date Of Birth:</div>
            <div class="d-inline-block text-item">
                <input class="disable" type="date" id="date" value="<?= $user_dob?>">
            </div>
        </div>
    </div>
</div>
<?php
    $set = ob_get_clean();

    echo $set;
?>