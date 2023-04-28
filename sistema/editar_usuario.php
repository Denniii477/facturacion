<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include './includes/scripts.php'; ?>
		<title>Editar Usuarios</title>
</head>
<body>
	<?php include './includes/header.php';
          include './includes/edit_user.php'; ?>
		<section id="container">
            <div class="form_registrer">
			<h1>Editar Usuario</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
            <form action="" method="post">
                <input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">
                <label for="correo">Correo Electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo Electronico" value="<?php echo $email; ?>">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
                <label for="clave">Contraseña</label>
                <input type="password" name="clave" id="clave" placeholder="Contraseña">
                <label for="rol">Tipo de Usuario</label>
                <?php
                    $query_rol= mysqli_query($conection, 
                                "SELECT *
                                   FROM rol");
                    $result_rol= mysqli_num_rows($query_rol);
                ?>               
                <select name="rol" id="rol" class="notItemOne" >
                <?php
                    echo $option;
                    if($result_rol>0){  
                        while ($rol=mysqli_fetch_array($query_rol)){
                ?>
                    <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
                <?php       
                    }
                    }
                ?>                   
                </select>
                <input type="submit" value="Editar Usuario" class="btn_save">
            </form>
            </div>
		</section>
	<?php include './includes/footer.php'; ?>
</body>
</html>