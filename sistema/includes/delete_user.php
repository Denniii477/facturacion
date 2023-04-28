<?php
include "../conexion.php";
if(!empty($_POST)){
    if($_POST['idusuario']==1){
        header("location: lista_usuarios.php");
        exit;
    }
    $idusuario=$_POST['idusuario'];
    ////////////
    //Eliminar//
    ////////////
    /*$query_delete=mysqli_query($conection,
                "DELETE
                   FROM usuario
                  WHERE idusuario=$idusuario");*/
    ///////////////////////////////////
    //sacar de vista pero no de la BD//
    ///////////////////////////////////
    $query_delete=mysqli_query($conection,
                "UPDATE usuario
                    SET estatus= 0
                  WHERE idusuario= $idusuario");
    if($query_delete){
        header("location: lista_usuarios.php");
    }else{
        echo "Error al eliminar";
    }
}
////////////////////////////////////////////
//PARA QUE NO PASE DEL NUMERO DE REGISTROS//
////////////////////////////////////////////
if(empty($_REQUEST['id']) || $_REQUEST['id']==1){
    header("location: lista_usuarios.php");
}else{
    $idusuario=$_REQUEST['id'];
    $query= mysqli_query($conection,
                "SELECT u.nombre, u.usuario, r.rol
                   FROM usuario u
             INNER JOIN rol r
                     ON u.rol= r.idrol
                  WHERE u.idusuario= $idusuario");
    $result= mysqli_num_rows($query);
    if($result>0){
        while ($data = mysqli_fetch_array($query)){
                $nombre=$data['nombre'];
                $usuario=$data['usuario'];
                $rol=$data['rol'];
               }
    }else{
        header("location: lista_usuarios.php");
        }
}