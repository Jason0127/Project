<?php
    ob_start();

    $items = $_POST['items'];
?>

<?php foreach($items as $item):?>
    <div class="c-col-12 col-lg-3 col-md-4 col-6">
        <div class="view overlay zoom">
            <img src="./img/<?= $item['product_img']?>" alt="" class="product-img img-fluid">
            <a onclick=productItemModal(<?= $item['id']?>)>
                <div class="mask flex-center waves-effect waves-light"></div>
            </a>
        </div>
        <p class="note note-primary text-truncate">
            <strong>Description: </strong><?= $item['product_desc']?><br/>
            <strong>Price: </strong><?= $item['product_price']?>
        </p>
    </div>

<?php endforeach?>

<?php
    $set = ob_get_clean();

    echo $set;
?>