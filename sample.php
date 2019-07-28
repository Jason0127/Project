<?php

    $begginer = 'foo';

    $array = array(
        0 => 'bar'
    );

    // print_r( array_merge(array($begginer), $array));

    $array1 = array(
        0 => array(
            'id' => 1
            ),
        1 => array(
            'id' => 2
            )
        );

    $array2 = array(
        3 => array('id' => 3)
    );

    // for($i = 0; $i < sizeof($array1); $i++){
    //     if($array1[$i]['id'] == 1){
    //         $array1[$i]['id'] = 123;
    //     }
    // }

    print_r(array_merge($array1,$array2));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
        .parent span:nth-of-type(1){
            background-color: red;
            width: 100%;
            height: 2px;
        }
    </style>

    <title>Document</title>
</head>
<body>
    <div class="parent">
        <div></div>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="animaiton"></div>
</body>
</html>