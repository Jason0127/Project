<?php ob_start();
    $item = $_POST['product']
?>

<div class="modal fade" id='myModal' tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel"><?= $item['product_name']?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class='message-cart'>
                    <div class='alert alert-danger'>You Must Be Login First!</div>
                </div> -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-6">
                        <img src="./img/<?= $item['product_img']?>" alt="img" class="img-fluid full-img">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Description</h4>
                                <p class="card-text"><?= $item['product_desc']?></p>
                            </div>
                        </div>
                        <div class="md-form form-sm">
                            <input type="number" id="qty" class="form-control form-control-sm" min="0">
                            <label for="qty">Quantity</label>
                        </div>
                        <div class="md-form form-sm">
                            <p>Storage: <?= $item['product_qty']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm" id="add-to-cart">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

<?php $set = ob_get_clean();

    $res = array(
        'set' => $set,
        'item' => $item
    );

    echo json_encode($res);
?>