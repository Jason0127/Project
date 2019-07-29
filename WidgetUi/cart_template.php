<?php
    ob_start();

    $sub_total = 0;

    function peso($data){
        return '&#8369;' . $data . '.00';
    }

    function qty($data){
        return $data . ' qty';
    }

?>
<?php 
    if(isset($_POST['items'])){
        foreach($_POST['items'] as $item){
            $total_price = (int)$item['product_price'] * (int)$item['qty'];
            $sub_total += $total_price;
?> 
            <tbody>
                <th class="text-truncate prod-td-size"><?= $item['product_name']?></th>
                <th><?= $item['product_price']?></th>
                <th><?= qty($item['qty'])?></th>
                <th><?= peso($total_price)?></th>
            </tbody
<?php
        }
    }
?>
<?php
    $set = ob_get_clean();

    $res = array(
        'set' => $set,
        'sub_total' => $sub_total
    );

    echo json_encode($res);

?>