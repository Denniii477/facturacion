<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include './includes/scripts.php'; ?>
		<title>Usuarios</title>
</head>
<body>
	<?php include './includes/header.php';
          include './includes/registrer_user.php'; ?>
		<section id="container">
            <div class="form_registrer">
			<h1>Registros de Usuarios</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
            <form action="" method="post">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                <label for="correo">Correo Electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo Electronico">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                <label for="clave">Contraseña</label>
                <input type="password" name="clave" id="clave" placeholder="Contraseña">
                <label for="rol">Tipo de Usuario</label>
                <?php
                    $query_rol= mysqli_query($conection, 
                                "SELECT *
                                   FROM rol");
                    mysqli_close($conection);
                    $result_rol= mysqli_num_rows($query_rol);
                ?>               
                <select name="rol" id="rol">
                <?php
                    if($result_rol>0){  
                        while ($rol=mysqli_fetch_array($query_rol)){
                ?>
                    <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
                <?php       
                    }
                    }
                ?>                   
                </select>
                <input type="submit" value="Crear Usuario" class="btn_save">
            </form>
            </div>
		</section>
	<?php include './includes/footer.php'; ?>
</body>
</html>