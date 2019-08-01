<?php
    ob_start();
    $address = (isset($_GET['address']) ? $_GET['address'] : '');
?>

<div class="modal fade" id="edit-address-modal">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <div class="md-form add-form-address">
                    <input type="text" id='ffname' class="form-control" value="<?= $address['user_fname_a']?>">
                    <label for="fname" class="active">First Name*</label>
                    <div>This Field is required</div>
                </div>
                <div class="md-form add-form-address">
                    <input type="text" id='llname' class="form-control" value="<?= $address['user_lname_a']?>">
                    <label for="lname" class="active">Last Name*</label>
                    <div>This Field is required</div>
                </div>
                <div class="md-form add-form-address">
                    <input type="text" id="pphone" class="form-control" value="<?= $address['user_cpno_a']?>">
                    <label for="phone" class="active">Phone*</label>
                    <div>This Field is required</div>
                </div>
                <div class="md-form add-form-address">
                    <input type="text" id="sstreet" class="form-control" value="<?= $address['user_street']?>">
                    <label for="street" class="active">Street*</label>
                    <div>This Field is required</div>
                </div>
                <div class="md-form add-form-address">
                    <input type="text" id="bbarangay" class="form-control" value="<?= $address['user_barangay']?>">
                    <label for="barangay" class="active">Barangay*</label>
                    <div>This Field is required</div>
                </div>
                <div class="md-form add-form-address">
                    <input type="text" id="ccity" class="form-control" value="<?= $address['user_city']?>">
                    <label for="city" class="active">City*</label>
                    <div>This Field is required</div>
                </div>

                <div class="md-form">
                    <button type="submit" class="btn form-control c-btn-round my-btn-color" id="btn-add-addres-save">Save</button>
                </div>


            </div>

        </div>
    </div>

</div>

<?php
    $set = ob_get_clean();
    echo $set;
?>