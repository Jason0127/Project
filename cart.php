<?php
    include_once './includes/head.php';
?>
<body style="display: none">
    <header>
        <?php include_once './includes/nav.php';?>
    </header>

    <div class="container cart_tbl" id="cart" style="margin-top: 5.5rem">
        <h3 class="text-center font-weight-bolder">Cart</h3>
        <!-- Cart Items -->
        <table class="table table-striped mt-4">
            <thead>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </thead>
            <!-- Cart -->
        </table>

        <hr class="my-4 border border-dark"/>

        <div class="sub-total d-flex justify-content-end align-items-center mb-5">
            <div class="d-inline-block font-weight-bolder">Sub Total: </div>
            <div class="sub-total-text d-inline-block"></div>
            <button onclick="checkOut()" class="btn btn-check-out">Check Out</button>
        </div>
    </div>
    
    


    <?php include_once './includes/scripts.php'; ?>
    <!-- Scripts -->
    <script type="text/javascript">

        let cartItems = JSON.parse(localStorage.getItem('cart'));
        const itemCart = {
            subTotal: ''
        }

        const updateCart = ()=>{
            $.ajax({
                url: './server/controller.php',
                method: 'POST',
                data: {updateProduct: 1, cartItems}
            })
            .done((data)=>{
                const res = JSON.parse(data);
                if(res.status !== false){
                    localStorage.removeItem('cart');
                    loadCartItem()
                    return console.log('OK')
                }
                console.log('errrrr')
            })
        }

        const checkOut = () =>{
            $.ajax({
                url: './server/controller.php',
                method: 'POST',
                data: {checkOut: 1}
            })
            .done((data)=>{
                const res = JSON.parse(data)
                if(res.status !== false){
                    updateCart();
                    return console.log('check')
                }
                console.log('qwe')
            })
        }

        const pesosTemplate = (data)=>{
            return '&#8369;' + data  + '.00'
        }

        const loadCartItem = (items = null)=>{
            $.ajax({
                url: './WidgetUi/cart_template.php',
                method: 'POST',
                data: {items}
            })
            .done((data)=>{
                let res = JSON.parse(data)
                itemCart.subTotal = res.sub_total
                $('#cart table').html('')
                $('#cart .sub-total .sub-total-text').html('')
                $('#cart table').append(res.set)

                $('#cart .sub-total .sub-total-text').append(pesosTemplate(itemCart.subTotal))
            })
        }

        const auth = ()=>{
            $.ajax({
                url: './server/auth.php',
                method: 'GET',
                data: {auth: 1}
            })
            .done((data)=>{
                let res = JSON.parse(data)
                console.log(res)
                if(res.status === false){
                    return window.location.href = 'index.php'
                }

                $('body').css({'display': 'unset'})
                return true;
            })
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

        const onCart = ()=>{
            let query = location.search.substr(1).split('&').toString();
            let user = query.split('=')[1]
            let userInfo = {
                user_name: user,
                cart: cartItems
            }

            loginInfo(userInfo)
            loadCartItem(cartItems ? cartItems : null)
        }

        $(document).ready(()=>{
            
            auth();
            onCart();
            // const getCart = ()=>{
            //     $.ajax({
            //         url: './server/controller.php',
            //         method: 'GET',
            //         data: {getCart: 1}
            //     })
            //     .done((data)=>{
            //         alert(data)
            //     })
            // }
        })
    </script>
<?php 
    include_once './includes/footer.php';

?>