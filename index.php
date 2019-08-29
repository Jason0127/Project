<?php
	include_once './includes/head.php';
?>
<body>
	<header>
		<?php include_once './includes/nav.php';?>
		<div class="banner-img">
			<!-- <img src="./vendor/img/img(137).jpg" alt="img" style="width: 100%;" class="img-fluid"> -->
			<div class="banner">
				<div class="banner-text">Nakiki Siguro ang product ay laging bago</div>
				<a href="#products" class="btn goto-products">
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
		</div>
	</header>
	<div class="message-add-cart">
		<div class="alert alert-success" role="alert">
			Added Successfuly!
		</div>
	</div>

	<div class="container mt-4">

		<div id="bestFeat" class="text-center mb-5">
			<h2 class="font-weight-bolder">Features</h2>
			<div class="row d-flex justify-content-center mb-4">
				<div class="col-md-8">
					<p class="grey-text">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi voluptate 
						hic provident nulla repellat facere esse molestiae ipsa labore porro minima 
						quam quaerat rem, natus repudiandae debitis est sit pariatur.
					</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-4 mb-4 besfeat-item">
					<i class="fas fa-shopping-basket fa-4x orange-text"></i>
					<h4 class="font-weight-bold my-4">Store</h4>
					<p class="grey-text">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
						sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim 
						ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
						ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
						cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				</div>
				<div class="col-md-6 col-lg-4 mb-4 besfeat-item">
					<i class="fas fa-heart fa-4x red-text"></i>
					<h4 class="font-weight-bold my-4">Happiness</h4>
					<p class="grey-text">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
						sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim 
						ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
						ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
						cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				</div>
				<div class="col-md-6 col-lg-4 mb-4 besfeat-item">
					<i class="fas fa-shipping-fast fa-4x orange-text"></i>
					<h4 class="font-weight-bold my-4">Shipping</h4>
					<p class="grey-text">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
						sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim 
						ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
						ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
						cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				</div>
			</div>
		</div>

		<hr class="my-4"/>

		<div>
			<h2 class="font-weight-bolder text-center mb-4">Products</h2>
			<div class="row" id="products">
				<!-- Products -->
			</div>
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

		// Product Iem
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
			console.log(products)
		})
		
		const loadProductItems = (items)=>{
			$.ajax({
				url: './WidgetUi/product_items.php',
				method: 'POST',
				data: {items}
			})
			.done((data)=>{
				// console.log(data)
				$('#products').append(data)
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
				if(res.status !== false){
					let userInfo = {
						cart: JSON.parse(localStorage.getItem('cart')),
						user_name: res[0].user_name
					}
					console.log(userInfo)
					loginTemplate(userInfo)
				}
			})
		}

		auth();

		const navBtnLogin = ()=>{
			let widths = $(window).width()
			// console.log(widths)
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

		const bestFeatAni = (vscroll, elem)=>{
			let height = $(window).height();
			let onload = height + vscroll - 50
			let elementPos = elem.offset().top;
			// console.log(elem)
			if(elementPos <= onload){
				elem.addClass('load');
			}else{
				elem.removeClass('load')
			}
		}

		const setAnimationBestFeat = (vscroll)=>{
			$('#bestFeat .besfeat-item').map((item) =>{
				item += 1
				bestFeatAni(vscroll, $(`#bestFeat .besfeat-item:nth-of-type(${item.toString()})`))
			})
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
			$('.banner-img .banner').css({'transform': `translateY(${scrollVal}px)`});
		}

		$(window).scroll((e)=>{
			let vscroll = $(this).scrollTop();
			navBarAnimation(vscroll);
			shopButtonAnimation(vscroll);
			setAnimationBestFeat(vscroll);
		})

		// page Load
		$(document).ready((e)=>{
			navBtnLogin();
			setAnimationBestFeat($(this).scrollTop())
		})

		$(window).resize((e)=>{
			navBtnLogin();
		})

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
			let userInfo = user
			userData = user
			if(userInfo.status === false) return false;
			console.log(user)
			$.ajax({
				url: './WidgetUi/login_template.php',
				method: 'POST',
				data: {userInfo}
			})
			.done((data)=>{
				$('#login-btn').remove();
				if(typeof $('#navbarSupportedContent-333 #user-cart-template')[0] === 'undefined' || undefined){
					$('#navbarSupportedContent-333').append(data);
				}else{
					$('#navbarSupportedContent-333 #user-cart-template').remove()
					$('#navbarSupportedContent-333').append(data);
				}

			})
		}

		// Handle Login
		$('#login_form').on('submit', (e)=>{
			e.preventDefault();

			console.log($('#parent'))

			// console.log(this.$('#email').val())
			// console.log(this.$('#password').val())
			
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
					console.log(data)
					let userInfo = JSON.parse(data)
					localStorage.setItem('cart', JSON.stringify(userInfo.cart))
					loginTemplate(userInfo)
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
					prevItem: localStorage.getItem('cart'),
					qty: this.$('#qty').val(),
					userId: userData.id
				}
				})
				.done((data)=>{
					let res = JSON.parse(data)
					// console.log(data)
					if(res.status !== false){
						localStorage.setItem('cart', JSON.stringify(res.new_cart))
						let userInfo = {
							user_name: userData.user_name,
							cart: res.new_cart
						}
						loginTemplate(userInfo)
						$('#myModal').modal('hide')
						$('.message-add-cart').addClass('alert-show')
						timeAdd = setTimeout(()=>{
							$('.message-add-cart').removeClass('alert-show')
						}, 3000)
					}else{
						$('#formodal .modal-body .row').before("<div class='message-cart'><div class='alert alert-danger'>Out Of Stock!</div></div>")
						setTimeout(()=>{
							$('#formodal .message-cart').addClass('alert-show hide')
						}, 100)
					}
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