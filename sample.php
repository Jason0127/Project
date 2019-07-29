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
        .animaiton{
            width: 300px;
            height: 300px;
            background: red;
            transition: all 2s ease-in;
        }
        .box{
            background: red; 
            width: 20px; 
            height: 20px;
        }
        /* .parent span:nth-of-type(1){
            background-color: red;
            width: 100%;
            height: 2px;
        } */

        .effect{
            outline: none;
            border: 0; 
            padding: 7px 0; 
            border-bottom: 1px solid #ccc;
            color: #333; 
            width: 100%; 
            box-sizing: border-box; 
            letter-spacing: 1px;
        }

        .border{
            position: absolute; 
            bottom: 0; 
            left: 0; 
            width: 0;
            height: 2px; 
            background-color: #4caf50; 
            transition: all 1s ease-in;
        }

        .effect:focus ~ .border{
            width: 100%;
            /* transition: 1s; */
        }

        .parent{
            position: relative;
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
    <div class="parent">
        <input type="text" class="effect" placeholder="asdasdasdasd">
        <span class="border"></span>
    </div>
    <!-- <a href="sample1.php"></a>
    <div class="animaiton"></div> -->

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