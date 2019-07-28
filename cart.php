<?php
    include_once './includes/head.php';
?>
<body>
    <header>
        <?php include_once './includes/nav.php';?>
    </header>
    <?php include_once './includes/scripts.php'; ?>
    <!-- Scripts -->
    <script type="text/javascript">
        $(document).ready(()=>{
            const auth = ()=>{
                $.ajax({
                    url: './server/auth.php',
                    method: 'GET',
                    data: {auth: 1}
                })
                .done((data)=>{
                    let res = JSON.parse(data)
                    if(res.status === false){
                        window.location.href = 'index.php'
                    }
                })
            }
            auth()
            const getCart = ()=>{
                $.ajax({
                    url: './server/controller.php',
                    method: 'GET',
                    data: {getCart: 1}
                })
                .done((data)=>{
                    alert(data)
                })
            }
        })
    </script>
<?php include_once './includes/footer.php';?>