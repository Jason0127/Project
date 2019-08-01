<?php
    include_once './includes/head.php';
?>
<body style="display: none">
    <header>
        <?php include_once './includes/nav.php';?>
    </header>
    <div class="container user_profile" style="margin-top: 5rem">
        <h3 class="text-center font-weight-bolder">Profile</h3>
        <div class="row">
            <div class="col-md-4 mt-3">
                <div class="card p-4 d-flex justify-content-center align-items-center option">
                    <div class="user_icon mt-4">
                        <i class="far fa-user fa-6x grey-text"></i>
                    </div>
                    <div class="my-4 w-100 options-nav">
                        <nav>
                            <li class="d-flex position-relative border-bottom py-1">
                                <a class="p-2 grey-text text-decoration-none" id="link-overview">
                                    <i class="fas fa-home grey-text mx-3" style="font-size: 1rem"></i>
                                    Overview
                                </a>
                                <span class="line active"></span>
                            </li>
                            <li class="d-flex position-relative border-bottom py-1">
                                
                                <a class="p-2 grey-text text-decoration-none" id="link-address">
                                    <i class="fas fa-map-marker-alt grey-text mx-3" style="font-size: 1rem"></i>
                                    Address
                                </a>
                                <span class="line"></span>
                            </li>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="profile-container mt-3 col-md-8 d-grid align-items-center mb-5">
                <!-- Profile Container -->
            </div>

        </div>
        

        <button class="btn btn-save-bgcolor" style="position: fixed" id="btn-save" onclick="updateOverviewbtn()">Update</button>

    </div>

    <div class="modal fade" id="add-address-modal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form id="add-address-submit">

                        <div class="md-form add-form-address">
                            <input type="text" id='fname' class="form-control">
                            <label for="fname">First Name*</label>
                            <div>This Field is required</div>
                        </div>
                        <div class="md-form add-form-address">
                            <input type="text" id='lname' class="form-control">
                            <label for="lname">Last Name*</label>
                            <div>This Field is required</div>
                        </div>
                        <div class="md-form add-form-address">
                            <input type="text" id="phone" class="form-control">
                            <label for="phone">Phone*</label>
                            <div>This Field is required</div>
                        </div>
                        <div class="md-form add-form-address">
                            <input type="text" id="street" class="form-control">
                            <label for="street">Street*</label>
                            <div>This Field is required</div>
                        </div>
                        <div class="md-form add-form-address">
                            <input type="text" id="barangay" class="form-control">
                            <label for="barangay">Barangay*</label>
                            <div>This Field is required</div>
                        </div>
                        <div class="md-form add-form-address">
                            <input type="text" id="city" class="form-control">
                            <label for="city">City*</label>
                            <div>This Field is required</div>
                        </div>

                        <div class="md-form">
                            <button type="submit" class="btn form-control c-btn-round my-btn-color" id="btn-add-addres-save">Save</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>

    <form id="edit-address">
        <!-- Modal -->
    </form>

<?php include_once './includes/scripts.php'?>
<!-- Scripts -->

<script type="text/javascript">
    let idKey
    let userInfo = []
    let userAddress = []
    let data = true

    const messageActtion = (messsageText, type = 'success')=>{
        let message = `
            <div class="d-flex justify-content-center update-mesage">
                <div class="alert alert-${type}" role="alert">
                    ${messsageText}
                </div>
            </div>
        `;

        $('body').prepend(message)
        setTimeout(()=>{
            $('.update-mesage').addClass('show');
            setTimeout(()=>{
                $('.update-mesage').addClass('hide');
                setTimeout(()=>{
                    $('.update-mesage').remove();
                }, 600)
            }, 3000)
        }, 10)
    }

    const updateOverview =(overview)=>{
        $.ajax({
            url: './server/controller.php',
            method: 'POST',
            data: {updateOverview: 1, overview}
        })
        .done((data)=>{
            const res = JSON.parse(data);
            // alert(data)
            console.log(res)
            if(res.update !== false){
                return messageActtion('Updated Successfully')
            }

            messageActtion('Something Went Wrong!! Try To Reaload The Page', 'danger')
        })
    }

    const updateOverviewbtn = ()=>{
        if(data){
            $('.user_profile #btn-save').html('');
            $('.user_profile #btn-save').append('Save');
            $('.profile input').addClass('enable');
            $('.profile select').addClass('enable');
            data = false

        }else{
            $('.user_profile #btn-save').html('');
            $('.user_profile #btn-save').append('Update');
            $('.profile input').removeClass('enable');
            $('.profile select').removeClass('enable');
            const fullName = $('.overview #name').val().split(' ');
            const dob = $('.overview #date').val()
            const cpno = $('.overview #phone_number').val()
            const gender = $('.overview #gender').val()
            const overview = {
                fName: fullName[0],
                lName: fullName[1],
                dob: dob,
                cpno: cpno,
                gender: gender
            }
            updateOverview(overview)
            data = true
        }
    }
    // Overview Function

    const overview = (user)=>{
            $.ajax({
                url: './WidgetUi/overview_temp.php',
                method: 'GET',
                data: {user}
            })
            .done((data)=>{
                if($('.user_profile .profile-container .profile')[0] == undefined){
                    $('.user_profile .profile-container .profile-address').addClass('hidee')
                    setTimeout(()=>{
                        $('.user_profile .profile-container').html('')
                        $('.user_profile .profile-container .profile-address').remove()
                        $('.user_profile .profile-container').append(data)
                        setTimeout(()=>{
                            $('.user_profile .profile-container .profile').removeClass('hidee')
                        }, 20)
                    }, 540)
                }
                
            })
        }

    $('.option .options-nav #link-overview').on('click', (e)=>{
        $('#btn-save').css({'display': 'block'})
        let innter;
        clearInterval(innter)
        $(e.target).css({'pointer-events': 'none'});
        $('.option .options-nav #link-address').css({'pointer-events': 'none'})
        innter = setTimeout(()=>{
            // $(e.target).css({'pointer-events': 'all'});
        $('.option .options-nav #link-address').css({'pointer-events': 'all'})
        }, 600)
        overview(userInfo)
        $('.option .options-nav #link-address').next().removeClass('active')
        $(e.target).next().addClass('active')
    })

    // Adress Funtion

    const address = (userAddress)=>{
        $.ajax({
            url: './WidgetUi/address_temp.php',
            method: 'GET',
            data: {userAddress}
        })
        .done((data)=>{
            if($('.user_profile .profile-container .profile-address')[0] == undefined){
                $('.user_profile .profile-container .profile').addClass('hidee')
                setTimeout(()=>{
                    $('.user_profile .profile-container').html('')
                    $('.user_profile .profile-container .profile').remove()
                    $('.user_profile .profile-container').append(data)
                    setTimeout(()=>{
                        $('.user_profile .profile-container .profile-address').removeClass('hidee')
                    }, 20)
                },540)
            }else{
                setTimeout(()=>{
                    $('.user_profile .profile-container').html('')
                    $('.user_profile .profile-container .profile').remove()
                    $('.user_profile .profile-container').append(data)
                    setTimeout(()=>{
                        $('.user_profile .profile-container .profile-address').removeClass('hidee')
                    }, 20)
                },540)
            }
        })
    }

    $('.option .options-nav #link-address').on('click', (e)=>{
        $('#btn-save').css({'display': 'none'})
        let innter;
        clearInterval(innter)
        $(e.target).css({'pointer-events': 'none'});
        $('.option .options-nav #link-overview').css({'pointer-events': 'none'})
        innter = setTimeout(()=>{
            // $(e.target).css({'pointer-events': 'all'});
            $('.option .options-nav #link-overview').css({'pointer-events': 'all'})
        }, 600)
        address(userAddress);
        $('.option .options-nav #link-overview').next().removeClass('active');
        $(e.target).next().addClass('active')
    })

    // Update Address
    const UpdateAddress = (id)=>{
        let address
        userAddress.map((item, key)=>{
            if(parseInt(item.address_id) === parseInt(id)){
                console.log(item)
                address = item
                idKey = {
                    address_id: item.address_id,
                    key: key
                }
            }
        })
        $.ajax({
            url: './WidgetUi/edit_modal.php',
            method: 'GET',
            data: {id: id, address}
        })
        .done((data)=>{
            $('#edit-address').html('');
            $('#edit-address').append(data);
            $('#edit-address-modal').modal('toggle');
        })
    }

    $('#edit-address').on('submit', (e)=>{
        e.preventDefault();
        let newAddress = {
            address_id: idKey.address_id,
            user_fname_a: $('#ffname').val(),
            user_lname_a: $('#llname').val(),
            user_cpno_a: $('#pphone').val(),
            user_street: $('#sstreet').val(),
            user_barangay: $('#bbarangay').val(),
            user_city: $('#ccity').val()
        }
        $.ajax({
            url: './server/controller.php',
            method: 'POST',
            data: {updateAddress: 1, newAddress}
        })
        .done((data)=>{
            const res = JSON.parse(data)
            $('#edit-address-modal').modal('toggle');
            if(res.status !== false){
                userAddress.splice(idKey.key, 1, newAddress)
                address(userAddress)
                return messageActtion('Update Successfully')
            }
            messageActtion('Something Went Wrong!! Try To Reaload The Page', 'danger')
        })
    })


    // Delete Address Function

    const Delete = (id)=>{
        $.ajax({
            url: './server/controller.php',
            method: 'POST',
            data: {deleteAddress: 1, id: id}
        })
        .done((data)=>{
            // alert(data)
            const res = JSON.parse(data)
            if(res.status !== false){
                messageActtion('Delete SuccessFuly')
                userAddress.map((item, key)=>{
                    if(id == item.address_id){
                        userAddress.splice(key, 1)
                        console.log(userAddress)
                        address(userAddress)
                    }
                })
            }else{
                messageActtion('Something Went Wrong!! Try To Reaload The Page', 'danger')
            }
        })
        
    }


    // Add Address Funtion

    const noErrorAddress = (addresInfo)=>{
        $.ajax({
            url: './server/controller.php',
            method: 'POST',
            data: {addresInfo, addAddress: 1}
        })
        .done((data)=>{
            const res = JSON.parse(data);
            $('#add-address-modal').modal('toggle')
            if(res.status !== false){
                return messageActtion('Added Successfully')
            }
            messageActtion('Something Went Wrong!! Try To Reaload The Page', 'danger')
        })
    }

    $('#add-address-submit').on('submit', (e)=>{
        e.preventDefault();

        let len = userAddress.length;
        console.log(len)
        let id = len == 0  ? 0 : userAddress[len - 1]['address_id'];
        id = id == null || '' ? 1 : parseInt(id) + 1 
        let addresInfo = {
            address_id: id,
            user_fname_a: $('#fname').val(),
            user_lname_a: $('#lname').val(),
            user_cpno_a: $('#phone').val(),
            user_street: $('#street').val(),
            user_barangay: $('#barangay').val(),
            user_city: $('#city').val()
        }

        let fieldsReq = {
            fName: $('#fname'),
            lName: $('#lname'),
            phone: $('#phone'),
            street: $('#street'),
            barangay: $('#barangay'),
            city: $('#city')
        }

        const requirements = ()=>{
            let val = true;
            for(const key of Object.keys(fieldsReq)){
                if(fieldsReq[key].val() == ''){
                    fieldsReq[key].next().next().addClass('show-error')
                    val = false;
                }else{
                    fieldsReq[key].next().next().removeClass('show-error')
                }
            }
            return val;
            

        }

        if(requirements()){
            noErrorAddress(addresInfo);
            userAddress.push(addresInfo);
            console.log(userAddress)
            address(userAddress)
        }

    })


    // Load Documents
    $(document).ready(()=>{

        let cart = JSON.parse(localStorage.getItem('cart'))
        const auth = ()=>{
            $.ajax({
                url: './server/auth.php',
                method: 'GET',
                data: {auth: 1}
            })
            .done((data)=>{
                let res = JSON.parse(data)
                // console.log(res[0])
                if(res.status !== false){
                    $('body').css({display: 'block'})
                    let user = {
                        cart: cart,
                        user_name: res[0].user_name
                    }
                    loginInfo(user)
                    userAddress = res[0].address_id == null || '' ? [] : res;
                    userInfo = res[0]
                    console.log(userAddress)
                    console.log(userInfo)
                    overview(userInfo)
                }else{
                    window.location.href = 'index.php'
                }
            })
        }
        auth()

        const setCapitalF = (data)=>{
            return data.charAt(0).toUpperCase() + data.slice(1).toLowerCase()
        }

        const loginInfo = (user)=>{
            let userInfo = user
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
    })

</script>

<?php 
// include_once './includes/footer.php';?>