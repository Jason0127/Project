<?php

    include_once './includes/head.php';
    
?>
<body style="display: none">
    <?php include_once './includes/nav.php';?>
    <div class="card craete-acc-form">
        <div class="card-header text-center indigo-text">Create Account</div>
        <form id="create-acc">
            <div class="card-body">
                <div class="md-form">
                    <input type="text" id="user_name" class="form-control">
                    <label for="user_name">Email</label>
                </div>
            
                <div class="md-form">
                    <input type="password" id="user_pass" class="form-control">
                    <label for="user_pass">Password</label>
                </div>

                <div class="md-form">
                    <input type="password" id="re_user_pass" class="form-control">
                    <label for="re_user_pass">Re-Type Password</label>
                </div>
            </div>

            <div class="md-form px-5">
                <button type="submit" class="btn btn-primary c-btn-round">Create</button>
            </div>
        </form>
    </div>

<?php
    include_once './includes/scripts.php';
?>


<script type="text/javascript">

    const isAuth = ()=>{
        $.ajax({
            url: '../server/auth.php',
            method: 'GET',
            data: {authAdmin: 1}
        })
        .done((data)=>{
            let res = JSON.parse(data)
            if(res.status === false || res.status === 'false'){
                return window.location.href = 'login.php'
            }
            $('body').css({display: 'block'})
        })
    }

    isAuth();

    $('#create-acc').on('submit', (e)=>{
        e.preventDefault();

        let formdata = {
            userName: this.$('#user_name').val(),
            userPass: this.$('#user_pass').val(),
            userRePass: this.$('#re_user_pass').val()
        }

        $.ajax({
            url: '../server/controller.php',
            method: 'POST',
            data: {create: 1, formdata}
        })
        .done((data)=>{
            alert(data)
        })
        
    })
</script>


<?php

    include_once './includes/footer.php'

?>
