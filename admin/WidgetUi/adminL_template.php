<?php
    ob_start();

    $user_data = $_POST['adminData']

?>

<ul class="navbar-nav ml-auto nav-flex-icons">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default">
            <a href="" class="dropdown-item"><?= $user_data['user_name']?></a>
            <a onclick="logout();">Logout</a>
        </div>
    </li>
</ul>

<?php
    $set = ob_get_clean();
    echo $set;
?>