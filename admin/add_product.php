<?php
    include_once './includes/head.php';
?>
<body style="display: none">
    <?php include_once './includes/nav.php';?>
    <div class="container">
        <form id="formhandler">
            <div class="add-product mt-5">
                
                <div class="md-form">
                    <input type="text" class="form-control" id="product_name">
                    <label for="product_name">Product Name:</label>
                </div>
            
        
                <div class="md-form">
                    <input type="text" class="form-control" id="product_price">
                    <label for="product_price">Price:</label>
                </div>
            
        
                <div class="md-form">
                    <input type="number" min="0" class="form-control" id="product_qty">
                    <label for="product_qty">Quantity</label>
                </div>
            
            
                <div class="md-form">
                    <input type="file" class="form-control" id="filepic" style="cursor: pointer;" onchange="filehander(this)"> 
                </div>
            
            
                <div class="md-form">
                    <textarea type="text" class="md-textarea form-control" id="product_desc" rows="3"></textarea>
                    <label for="product_desc">Description</label>
                </div>
              
                <div class="md-form">
                    <button class="btn btn-sm btn-primary">
                        Save
                    </button>
                </div>
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
            // alert(data)
            let res = JSON.parse(data)
            if(res.status === false){
                return window.location.href = 'login.php'
            }
            $('body').css({display: 'block'})
        })
    }

    isAuth();

    var imgName
    const filehander = (e)=>{
        let formdata = new FormData();
        // console.log($('#filepic').prop('files')[0]['name'])
        formdata.append('file', $('#filepic').prop('files')[0])
        // alert(formdata)
        $.ajax({
            url: '../server/file.php',
            datatype: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: formdata,                         
            method: 'post'
        })
        .done((data)=>{
            imgName = data
            // alert(imgName)
        })

      
    }

    $('#formhandler').on('submit', (e)=>{
        console.log(imgName);
        e.preventDefault();
        let data = {
            productName: this.$('#product_name').val(),
            productDesc: this.$('#product_desc').val(),
            productPrice: this.$('#product_price').val(),
            productQty: this.$('#product_qty').val(),
            productImg: imgName

        }
        
        $.ajax({
            url: '../server/controller.php',
            method: 'POST',
            data: {insertProd: 1, data}
        })
        .done((data)=>{
            alert(data)
        })
    })
</script>

<?php
    include_once './includes/footer.php';
?>