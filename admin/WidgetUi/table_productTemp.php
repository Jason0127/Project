<?php
    ob_start();
    $items = (isset($_POST['items']) ? $_POST['items'] : '');
?>
    <?php $x =0; foreach($items as $item):
        $x += 1    
    ?>
        <tr>
            <th scope="row"><?= $x?></th>
            <td class="text-truncate prod-td-size"><?= $item['product_name']?></td>
            <td class="text-truncate desc-td-size"><?= $item['product_desc']?></td>
            <td><?= $item['product_price']?></td>
            <td><?= $item['product_qty']?></td>
        </tr>
    <?php endforeach;?>
<?php
    $set = ob_get_clean();

    echo $set;
?>