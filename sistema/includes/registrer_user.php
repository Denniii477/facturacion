<?php
if($_SESSION['rol']!=1){
    header("location: ./");
}
include "../conexion.php";
if(!empty($_POST)){
    $alert='';
    if(empty($_POST['nombre']) || 
       empty($_POST['correo']) ||
       empty($_POST['usuario']) ||
       empty($_POST['clave'])||
       empty($_POST['rol'])){
        $alert='<div class="fond_error"><p class="msg_error">Todos los campos deben ser llenados.</p></div>';
       }else{
        $nombre=$_POST['nombre'];
        $email=$_POST['correo'];
        $user=$_POST['usuario'];
        $clave=md5($_POST['clave']);
        $rol=$_POST['rol'];
        $query= mysqli_query($conection, 
                    "SELECT *
                       FROM usuario
                      WHERE usuario='$user'
                         OR correo='$email'");
      
        $result= mysqli_fetch_array($query);
        if($result>0){
            $alert='<div class="fond_error"><p class="msg_error">El correo o el usuario ya existen.</p></div>';
        }else{
            $query_insert= mysqli_query($conection, 
                    "INSERT INTO usuario(nombre,correo,usuario,clave,rol)
                          VALUES ('$nombre','$email','$user','$clave','$rol')");
                if($query_insert){
                    $alert='<div class="fond_save"><p class="msg_save">Usuario creado correctamente.</p></div>';
                }else{
                    $alert='<div class="fond_error"><p class="msg_error">Error al crear el usuario.</p></div>';
                }
        }
    }
}