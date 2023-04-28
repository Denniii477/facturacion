<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include './includes/scripts.php'; ?>
		<title>Eliminar Usuario</title>
</head>
<body>
	<?php include './includes/header.php';
          include './includes/delete_user.php'; ?>
		<section id="container">
			<div class="data_delete">
                <h2>¿Esta seguro de eliminar el siguiente registro?</h2>
                <p>Nombre: <span><?php echo $nombre;?></span></p>
                <p>Usuario: <span><?php echo $usuario;?></span></p>
                <p>Tipo de Usuario: <span><?php echo $rol;?></span></p>
                <form method="post" action="">
                    <input type="hidden" name="idusuario" value="<?php echo $idusuario;?>">
                    <a href="lista_usuarios.php" class="btn_new">Cancelar</a>
                    <input type="submit" value="Aceptar" class="btn_aceptar">
                </form>
			</div>
		</section>
	<?php include './includes/footer.php'; ?>
</body>
</html>