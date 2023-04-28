<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'facturacion';
    /*$host = 'localhost';
    $user = 'id20586654_facturacions';
    $password = '13122191shayerA.';
    $db = 'id20586654_facturacion';*/

    $conection = @mysqli_connect($host, $user, $password, $db);

    if(!$conection){
        echo 'Error al conectar con la base de datos';
    }