<?php
$alert=''; //nos llenara el campo vacio en caso de que ocurra un error
session_start();
if(!empty($_SESSION['active'])){
    header('location: sistema/');
}else{
    if(!empty($_POST)){
        if(empty($_POST['usuario']) || empty($_POST['clave'])){
            $alert= 'Ingrese su Usuario y su Contraseña';
        }else{
            require_once "conexion.php";
            $user= mysqli_real_escape_string($conection, $_POST['usuario']); //para que no entre unsa insercion sql al codigo y ademas quita los caracteres raros
            $pass= md5(mysqli_real_escape_string($conection,$_POST['clave'])) ; //para codificar la contraseña
            //tiene que ser md5 tanto con el codigo como en la base de datos
            $query= mysqli_query($conection,
                    "SELECT * 
                       FROM usuario
                      WHERE usuario='$user'
                        AND clave='$pass'
                    ");
            mysqli_close($conection);
            $result= mysqli_num_rows($query);
            if($result>0){
                $data= mysqli_fetch_array($query);              
                $_SESSION['active']=true;
                $_SESSION['idUser']=$data['idusuario'];
                $_SESSION['nombre']=$data['nombre'];
                $_SESSION['correo']=$data['correo'];
                $_SESSION['user']=$data['usuario'];
                $_SESSION['rol']=$data['rol'];
                header('location: sistema/');
            }else{
                $alert='El usuario o la contraseña son incorrectos';
                session_destroy();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="login.css">
       <title>Login|Facturacion</title>
</head>
<body>
<!--div class="box">
    <section id="container">
        <form action="" method="post">
            <h3>Iniciar Sesion</h3>
            <img src="img/login.png" alt="Login">
            <input class="input" type="text" name="usuario" placeholder="Usuario">
            <input class="input" type="password" name="clave" placeholder="Contraseña">
            <div class="alert"><?php //echo isset($alert) ? $alert:''; ?></div>
            <input class="button is-info is-rounded" type="submit" value="INGRESAR">
    </section>

</div-->
<section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2>Iniciar Sesion</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="usuario" required>
                        <label for="">Usuario</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="clave" required>
                        <label for="">Contraseña</label>
                    </div>
                    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
                    <button>INGRESAR</button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    
</body>
</html>
