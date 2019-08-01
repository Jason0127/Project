<?php

    // $begginer = 'foo';

    // $array = array(
    //     0 => 'bar'
    // );

    // print_r( array_merge(array($begginer), $array));

    // $array1 = array(
    //     0 => array(
    //         'id' => 1
    //         ),
    //     1 => array(
    //         'id' => 2
    //         )
    //     );

    // $array2 = array(
    //     3 => array('id' => 3)
    // );

    // // for($i = 0; $i < sizeof($array1); $i++){
    // //     if($array1[$i]['id'] == 1){
    // //         $array1[$i]['id'] = 123;
    // //     }
    // // }

    // print_r(array_merge($array1,$array2));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="vendor/js/jquery-3.4.1.min.js"></script>
    <style>
       body{
           box-sizing: border-box;
       }

       .parent{
           height: 100vh;
           width: 100vw;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
       }

       .child{
           width: 50%;
           position: relative;
            /* background-color: red; */
            border: 1px solid red;
          flex: 0 0 50%;
          max-width: 50%
       }

    </style>

    <title>Document</title>
</head>
<body>

    <!-- <form action="sample1.php" method="POST">
        <input type="text" name="asdasd">
        <button type="submit">qweqweqwe</button>
        <div class="parent">
            <div></div>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </form> -->
    <!-- <div class="parent">
        <input type="text" class="effect" placeholder="asdasdasdasd">
        <span class="border"></span>
    </!--> 
    <!-- <a href="sample1.php"></a>
    <div class="animaiton"></div> -->

    <div class="parent">

       <div class="child"></div>
       <div class="child"></div>

    </div>


    <script tpye="text/javascript">
        const GO = ()=>{
            $.ajax({
                url: './sample1.php',
                method: 'POST',
                data: {send: 2}
            })
        }

    </script>

</body>
</html>