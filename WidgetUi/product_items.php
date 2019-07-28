<?php
    ob_start();


    if(isset($_POST['items'])){
        $items = $_POST['items'];
    }

?>

<?php 
    if(isset($_POST['items'])){
        foreach($items as $item){?>
            <div class="c-col-12 col-lg-3 col-md-4 col-6">
                <div class="view overlay zoom card">
                    <img src="./img/<?= $item['product_img']?>" alt="" class="product-img img-fluid">
                    <a onclick=productItemModal(<?= $item['id']?>)>
                        <div class="mask flex-center waves-effect waves-light"></div>
                    </a>
                </div>
                <p class="note text-truncate text-descript">
                    <strong>Description: </strong><?= $item['product_desc']?><br/>
                    <strong>Price: </strong><?= $item['product_price']?>
                </p>
            </div>
<?php   }; 
    }else{?>
        <div>Empty</div>
 <?php
    }?>

<?php
    $set = ob_get_clean();

    echo $set;
?>