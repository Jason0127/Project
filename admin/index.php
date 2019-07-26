<?php
    include_once './includes/head.php';
?>
<body style="display: none;">
    <?php include_once './includes/nav.php';?>

    <div class="modal fade" id="admin-login">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tittle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm-admin-login">
                        <div class="md-form">
                            <input type="text" class="form-control" id="username">
                            <label for="username">UserName</label>
                        </div>
                        <div class="md-form">
                            <input type="text" class="form-control" id="password">
                            <label for="password">Password</label>
                        </div>

                        <button class="btn c-btn-2bbbad c-btn-round" style="margin: 0;">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <a href="add_product.php" class="btn c-btn-2bbbad btn-sm">Add Product</a>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                </tr>
            </thead>
            <tbody id="products">
                <!-- load products -->
            </tbody>
        </table>
    </div>

<?php
    include_once './includes/scripts.php';
?>

<script async type="text/javascript">

    // $('body').css({'display': 'none'})

    const isAuth = ()=>{
        $.ajax({
            url: '../server/auth.php',
            method: 'GET',
            data: {authAdmin: 1}
        })
        .done((data)=>{
            let res = JSON.parse(data)
            console.log(res)
            if(res.status === false){
                window.location.href = 'login.php'
            }else{
                $('body').css({'display': 'block'})
                onLogin(data)
            }
        })
    }

    isAuth();

    const onLogin = (data)=>{
        let adminData = JSON.parse(data)
        console.log(adminData)
        $.ajax({
            url: './WidgetUi/adminL_template.php',
            method: 'POST',
            data: {adminData}
        })
        .done((data)=>{
            $('#navbarSupportedContent-admin').append(data)
        })
    }

//    $('#frm-admin-login').on('submit', (e)=>{
//        e.preventDefault();
//        let frmData = {
//            userName: this.$('#username').val(),
//            userPass: this.$('#password').val()
//        }

//        $.ajax({
//            url: '../server/controller.php',
//            method: 'POST',
//            data: {frmData, adminLogin: 1}
//        })
//        .done((data)=>{
//            let res = parseInt(data)
//             console.log(res)
//            if(data == '0' || data == 'false' || data == false || data == 0){
//                alert(data)
//            }else{
//                alert(data)
//                onLogin(data)
//            }
//        })
//    })

   const tableProd = ()=>{
       $.ajax({
           url: '../server/controller.php',
           method: 'GET',
           data: {getProductTable: 1}
       })
       .done((data)=>{
            let items = JSON.parse(data)
            loadTableProd(items)
       })
   }

   const loadTableProd = (items)=>{
        $.ajax({
            url: './WidgetUi/table_productTemp.php',
            method: 'POST',
            data: {items}
        })
        .done((data)=>{
            $('#products').append(data)
        })
   }


   $(document).ready((e)=>{
        tableProd()

   })
</script>

<?php
    include_once './includes/footer.php';
?>