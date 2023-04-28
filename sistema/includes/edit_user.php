<?php
include "../conexion.php";
if(!empty($_POST)){
    $alert='';
    if(empty($_POST['nombre']) || 
       empty($_POST['correo']) ||
       empty($_POST['usuario']) ||
       empty($_POST['rol'])){
        $alert='<div class="fond_error"><p class="msg_error">Todos los campos deben ser llenados.</p></div>';
       }else{
        $idusuario= $_POST['idusuario'];
        $nombre=$_POST['nombre'];
        $email=$_POST['correo'];
        $user=$_POST['usuario'];
        $clave=md5($_POST['clave']);
        $rol=$_POST['rol'];
        
        $query= mysqli_query($conection, 
                    "SELECT *
                       FROM usuario
                      WHERE (usuario='$user' AND idusuario != '$idusuario')
                         OR (correo='$email' AND idusuario != '$idusuario')");
        $result= mysqli_fetch_array($query);
        if($result>0){
            $alert='<div class="fond_error"><p class="msg_error">El correo o el usuario ya existen.</p></div>';
        }else{
            if(empty($_POST['clave'])){
                $sql_update= mysqli_query($conection, 
                        "UPDATE usuario
                            SET nombre='$nombre', correo='$email',usuario='$user',rol='$rol'
                          WHERE idusuario='$idusuario'");
            }else{
                $sql_update= mysqli_query($conection, 
                        "UPDATE usuario
                            SET nombre='$nombre', correo='$email',usuario='$user',clave='$clave',rol='$rol'
                          WHERE idusuario='$idusuario'");
            }
            if($sql_update){
                $alert='<div class="fond_save"><p class="msg_save">Usuario actualizado correctamente.</p></div>';
            }else{
                $alert='<div class="fond_error"><p class="msg_error">Error al actualizar el usuario.</p></div>';
                }
        }
    }
    mysqli_close($conection);
}
/////////////////
//Mostrar Datos//
/////////////////
if(empty($_GET['id'])){
    header('location: lista_usuarios.php');
    mysqli_close($conection);
}
$iduser= $_GET['id'];
$sql= mysqli_query($conection,
        "SELECT u.idusuario, u.nombre, u.usuario, u.correo, (u.rol)
             AS idrol, (r.rol)
             AS rol
           FROM usuario u
     INNER JOIN rol r
             ON u.rol= r.idrol
          WHERE idusuario=$iduser");
mysqli_close($conection);
$result_sql= mysqli_num_rows($sql);
if($result_sql==0){
    header('location: lista_usuarios.php');
}else{
    $option='';
    while($data= mysqli_fetch_array($sql)){
        $iduser= $data['idusuario'];
        $nombre= $data['nombre'];
        $email= $data['correo'];
        $usuario= $data['usuario'];
        $idrol= $data['idrol'];
        $rol= $data['rol'];

        if($idrol== 1){
            $option= '<option value="'.$idrol.'"select>'.$rol.'</option>';
        }else if($idrol== 2){
            $option= '<option value="'.$idrol.'"select>'.$rol.'</option>';
        }else if($idrol== 3){
            $option= '<option value="'.$idrol.'"select>'.$rol.'</option>';
        }
    }
}