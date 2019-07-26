<?php
    include_once './includes/head.php'
?>
<body style="display: none">
    <div id="parent-login">
        <form id="admin-login">
            <div class="card admin-login">

                <h4 class="text-white text-center font-weight-bolder" id="login-text">Login</h4>

                <div class="md-form mt-2">
                    <input type="text" id="username" class="form-control text-white">
                    <label for="username" class="c-white">Username</label>
                </div>

                <div class="md-form">
                    <input type="password" id="password" class="form-control text-white">
                    <label for="password" class="c-white">Password</label>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Login</button>

            </div>

            <div class="box"></div>

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
            if(res.status !== false){
                return window.location.href = 'index.php'
            }
            $('body').css({display: 'block'})
        })
    }

    isAuth();

    $('#admin-login').on('submit',(e)=>{
        e.preventDefault();

        let adminLogData = {
            userName: this.$('#username').val(),
            userPass: this.$('#password').val()
        }

        $.ajax({
            url: '../server/controller.php',
            method: 'POST',
            data: {adminLogin: 1, adminLogData}
        })
        .done((data)=>{
            // alert(data)
            if(data === false || data === 0 || data  === 'false' || data === '0'){
                alert('Invalid')
            }else{
                window.location.href = 'index.php'
            }
        }) 

    })
</script>

<?php
    include_once './includes/footer.php';
?>