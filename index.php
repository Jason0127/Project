<?php
	include_once './includes/head.php';
?>
<body>
	<?php include_once './includes/nav.php';?>
	<div class="banner-img">
		<!-- <img src="./vendor/img/img(137).jpg" alt="img" style="width: 100%;" class="img-fluid"> -->
		<a href="#prod" class="btn goto-products">
			<i class="fas fa-store mr-2" style="font-size: 1.3rem"></i>
			<div>
				<span class="shop-text">S</span>
				<span class="shop-text">H</span>
				<span class="shop-text">O</span>
				<span class="shop-text">P</span>
			</div>
			<span class="line"></span>
			<span class="line"></span>
			<span class="line"></span>
			<span class="line"></span>
		</a>
	</div>
	<div class="message-add-cart">
		<div class="alert alert-success" role="alert">
			Added Successfuly!
		</div>
	</div>
	<div class="container mt-5" id="prod">
		<div class="row" id="products">
			<!-- Products -->
		</div>
	</div>

	<form id="formodal"></form>

	<div id="login">
		<div class="modal fade" id="login-modal" tabindex="-1" role='dialog'>
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Login</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="login_form">

							<div class="md-form">
								<input type="text" class="form-control" id="email">
								<label for="email" id="lemail">Email</label>
							</div>

							<div class="md-form">
								<input type="password" class="form-control" id="password">
								<label for="password" id="lpassword">Password</label>
							</div>

							<button class="btn btn-primary c-btn-round btn-md" id="login">Login</button>

						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once './includes/scripts.php'?>

	<!-- SCRIPTS -->
	<script async type="text/javascript">
		const auth = ()=>{
			$.ajax({
				url: './server/auth.php',
				method: 'GET',
				data: {auth: 1}
			})
			.done((data)=>{
				let res = JSON.parse(data)
				console.log(res)
				if(res.status !== false){
					loginTemplate(data)
				}
			})
		}

		auth();

		const navBtnLogin = ()=>{
			let widths = $(window).width()
			console.log(widths)
			if(widths <= 990){
				let inNavbtnLogin = $('#navvv').children('#login-btn')[0]
				if(inNavbtnLogin == undefined){
					let btnLogin = $('#login-btn')
					$('#navvv #navbarSupportedContent-333 #login-btn').remove()
					$('#navvv #navbarSupportedContent-333').before(btnLogin)
				}
			}else if(widths >= 991){
				let inNavbtnLogin = $('#navvv').children('#login-btn')[0]
				if(inNavbtnLogin != undefined){
					let btnLogin = $('#login-btn')
					$('#navvv #login-btn').remove()
					$('#navvv #navbarSupportedContent-333').append(btnLogin)

				}
			}
		}

		const btnLoginHandle = ()=>{
			$('#login #email').val('');
			$('#login #password').val('');
			$('#login #lemail').removeClass('active')
			$('#login #lpassword').removeClass('active')
		}

		const navBarAnimation = (vscroll)=>{
			
			if(vscroll >= 90){
				let scrollVal =  vscroll / 3
				let scrollTotal = scrollVal - 30
				let positionVal = -50 + scrollTotal
				// console.log(scrollVal)
				// console.log(positionVal)
				$('.navbar-scroll').addClass('navbar-scrolled')
				$('.navbar-scroll .c-btn-login').addClass('c-btn-login-scrolled');
				$('.navbar-scroll').css({'position': 'fixed', 'top': (positionVal >= 0 ? 0 : positionVal) + 'px'})
			}else{
				// console.log('asdasdasdasdasdasdasd')
				$('.navbar-scroll').css({'position': 'absolute', 'top': '0'})
				$('.navbar-scroll').removeClass('navbar-scrolled');
				$('.navbar-scroll .c-btn-login').removeClass('c-btn-login-scrolled');
			}

		}

		const shopButtonAnimation = (vscroll)=>{
			let scrollVal = vscroll / 2;
			$('.banner-img .goto-products').css({'transform': `translateY(${scrollVal}px)`});
		}

		$(window).scroll((e)=>{
			let vscroll = $(this).scrollTop();
			navBarAnimation(vscroll);
			shopButtonAnimation(vscroll);
		})

		$(document).ready((e)=>{
			navBtnLogin();
		})

		$(window).resize((e)=>{
			navBtnLogin();
		})		

		let products
		let productItem
		let userData
		$.ajax({
			url: './server/controller.php',
			method: 'POST',
			data: {getProduct: 1}
		})
		.done((data)=>{
			products = JSON.parse(data)
			loadProductItems(products)
		})
		const loadProductItems = (items)=>{
			$.ajax({
				url: './WidgetUi/product_items.php',
				method: 'POST',
				data: {items}
			})
			.done((data)=>{
				$('#products').append(data)
			})
		}

		var timeAdd


		// open product Modal
		const productItemModal = (id)=>{
			$('.message-add-cart').removeClass('alert-show');
			clearTimeout(timeAdd);
			let product
			products.map((item)=>{
				if(id == item.id){
					product = item
				}
			})
			console.log(product);
			$.ajax({
				url: './WidgetUi/modal_product.php',
				method: 'POST',
				data: {product}
			})
			.done((data)=>{
				let res = JSON.parse(data);
				// console.log(res)
				$('#formodal').html('')
				$('#formodal').append(res.set);
				productItem = res.item
				// console.log($('#myModal')[0])
				// $('body').append(data);
				$('#myModal').modal('toggle')
				// console.log(data)
			})
		}

		const loginTemplate = (user)=>{
			let userInfo = JSON.parse(user)
			userData = userInfo
			if(userInfo.status === false) return false;
			console.log(userInfo)
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

		// Handle Login
		$('#login_form').on('submit', (e)=>{
			e.preventDefault();

			console.log($('#parent'))

			console.log(this.$('#email').val())
			console.log(this.$('#password').val())
			
			let logdata= {
				email: this.$('#email').val(),
				pass: this.$('#password').val()
			}

			$.ajax({
				url: './server/controller.php',
				method: 'POST',
				data: {login: 1 ,logdata}
			})
			.done((data)=>{
				if(data == 'false' || data == 0 || data == false){
					alert(data)
				}else{
					alert(data)
					loginTemplate(data)
					$('#login-modal').modal('hide')
				}
			})
		})

		// add To Cart
		$('#formodal').on('submit', (e)=>{
			e.preventDefault();
			// let cartdata = {
			// 	product_id = 'asd'
			// }
			console.log(userData)

			if(userData != undefined){
				// console.log(userData);
				$.ajax({
				url: './server/controller.php',
				method: 'POST',
				data: {
					cart: 1, 
					item: productItem, 
					qty: this.$('#qty').val(),
					userId: userData.id
				}
				})
				.done((data)=>{
					$('#myModal').modal('hide')
					$('.message-add-cart').addClass('alert-show')
					timeAdd = setTimeout(()=>{
						$('.message-add-cart').removeClass('alert-show')
					}, 3000)
				})
			}else{
				
				$('#formodal .modal-body .row').before("<div class='message-cart'><div class='alert alert-danger'>You Must Be Login First!</div></div>")
				setTimeout(()=>{
					$('#formodal .message-cart').addClass('alert-show hide')
				}, 100)
			}
			
		})

	</script>
<?php include_once './includes/footer.php';