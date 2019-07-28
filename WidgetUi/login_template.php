<?php

    ob_start();
   $user_data = $_POST['userInfo'];
   $cart_count = ($user_data['cart'] == null || '' ? 0 : sizeof($user_data['cart']));
?>

<ul class="navbar-nav ml-auto" id="user-cart-template">
    <li class="nav-item" style="z-index: 1">
        <a href="cart.php" class="nav-link">
            Cart
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-number"><?= $cart_count?></span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
            aria-labelledby="navbarDropdownMenuLink-333">
            <a class="dropdown-item" href="#"><?= $user_data['user_name']?></a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </li>
</ul>

<?php
    $set = ob_get_clean();
    echo $set;
?>