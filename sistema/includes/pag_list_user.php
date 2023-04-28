<?php
include '../conexion.php';
$sql_register= mysqli_query($conection,
                    "SELECT COUNT(*)
                         AS total_registro
                       FROM usuario
                      WHERE estatus=1");
$result_register= mysqli_fetch_array($sql_register);
$total_registro= $result_register['total_registro'];
$por_pagina=3;
if(empty($_GET['pagina'])){
    $pagina=1;
}else{
    $pagina=$_GET['pagina'];
}
$desde=($pagina-1)*$por_pagina;
$total_paginas=ceil($total_registro/$por_pagina);