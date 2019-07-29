<?php
    include_once './includes/head.php';
?>
<body>
    <header>
        <?php include_once './includes/nav.php';?>
    </header>
    <div class="container" style="margin-top: 5.5rem">
        <h3 class="text-center font-weight-bolder">Profile</h3>

        <div class="profile mt-5">
            <div class="info-item mb-5">
                <div class="info-item-label d-inline-block font-weight-bolder grey-text">Full Name:</div>
                <div class="d-inline-block text-item">
                    <input class="disable" type="text" id="name">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </div>

            <div class="info-item mb-5">
                <div class="info-item-label d-inline-block font-weight-bolder grey-text">Phone Number:</div>
                <div class="d-inline-block text-item">
                    <input class="disable" type="text" id="phone_number">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </div>

            <div class="info-item mb-5">
                <div class="info-item-label d-inline-block font-weight-bolder grey-text">Gender:</div>
                <select id="gender" class="disable">
                    <option value="0"></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="info-item mb-5">
                <div class="info-item-label d-inline-block font-weight-bolder grey-text">Date Of Birth:</div><input class="disable" type="date" id="date">
            </div>

            <button class="btn btn-save-bgcolor" id="btn-save" onclick="update()">Update</button>

        </div>

    </div>
<?php include_once './includes/scripts.php'?>
<!-- Scripts -->

<script type="text/javascript">
    let data = true
    const update = ()=>{
        if(data){
            $('.profile #btn-save').html('');
            $('.profile #btn-save').append('Save');
            $('.profile input').addClass('enable');
            $('.profile select').addClass('enable');
            data = false
        }else{
            $('.profile #btn-save').html('');
            $('.profile #btn-save').append('Update');
            $('.profile input').removeClass('enable');
        $('.profile select').removeClass('enable');
            data = true
        }
    }

    $(document).ready(()=>{
        let cart = JSON.parse(localStorage.getItem('cart'))
        const auth = ()=>{
            $.ajax({
                url: './server/auth.php',
                method: 'GET',
                data: {auth: 1}
            })
            .done((data)=>{
                let res = JSON.parse(data)
                console.log(res[0])
                if(!res.status){
                    let user = {
                        cart: cart,
                        user_name: res[0].user_name
                    }
                    loginInfo(user)
                    userBasicInfo(res[0])
                }
            })
        }
        auth()

        const setCapitalF = (data)=>{
            return data.charAt(0).toUpperCase() + data.slice(1).toLowerCase()
        }

        const userBasicInfo = (user)=>{
            $('#name')[0].value = user.user_fname ? setCapitalF(user.user_fname)  + ' ' + (user.user_lname ? setCapitalF(user.user_lname) : ' ') : ' ' ;
            $('#gender')[0].value = user.user_gender ? user.user_gender.toLowerCase() : '0';
            $('#date')[0].value = user.user_dob ? user.user_dob : null;
            $('#phone_number')[0].value = user.user_cpno ? user.user_cpno : '';
        }
        const loginInfo = (user)=>{
            let userInfo = user
            $.ajax({
                url: './WidgetUi/login_template.php',
                method: 'POST',
                data: {userInfo}
            })
            .done((data)=>{
                $('#login-btn').remove();
                $('#navbarSupportedContent-333').append(data);
            })
        }
    })
</script>