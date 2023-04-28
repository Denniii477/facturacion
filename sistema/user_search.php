<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include './includes/scripts.php'; ?>
		<title>Lista de Usuarios</title>
</head>
<body>
	<?php include './includes/header.php'; 
          include './includes/list_user.php';
          $busqueda=strtolower($_REQUEST['busqueda']);
          if(empty($busqueda)){
            header("location: lista_usuarios.php");
            mysqli_close($conection);

          } ?>
		<section id="container">
			<h1>Lista de Usuarios</h1>
            <a href="registro_usuarios.php" class="btn_new">Crear Usuarios</a>
            <!-- Buscador -->
            <form action="user_search.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
                <input type="submit" value="Buscar" class="btn_search">
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                <?php
                /////////////
                //PAGINADOR//
                /////////////
                $rol= '';
                if($busqueda=='administrador'){
                    $rol="OR rol LIKE '%1%'";
                }else if($busqueda=='supervisor'){
                    $rol="OR rol LIKE '%2%'";
                }else if($busqueda=='vendedor'){
                    $rol="OR rol LIKE '%2%'";
                }
                    $sql_register= mysqli_query($conection,
                                        "SELECT COUNT(*)
                                             AS total_registro
                                           FROM usuario
                                          WHERE (idusuario LIKE '%$busqueda%' 
                                                OR nombre LIKE '%$busqueda%'
                                                OR correo LIKE '%$busqueda%'
                                                OR usuario LIKE '%$busqueda%' $rol)
                                            AND estatus=1");
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

                    $query= mysqli_query($conection, 
                        "SELECT u.idusuario,
                                u.nombre,
                                u.correo,
                                u.usuario,
                                r.rol
                           FROM usuario u
                     INNER JOIN rol r
                             ON u.rol=r.idrol
                          WHERE (u.idusuario LIKE '%$busqueda%' 
                                 OR u.nombre LIKE '%$busqueda%'
                                 OR u.correo LIKE '%$busqueda%'
                                 OR u.usuario LIKE '%$busqueda%'
                                 OR r.rol LIKE '%$busqueda%')
                            AND estatus = 1
                       ORDER BY u.idusuario
                      ASC LIMIT $desde,$por_pagina");//cambiar de 0 a 1 de estatus para mostrar los borrados//
                    mysqli_close($conection);
                    
                    $result=mysqli_num_rows($query);
                    if($result>0){
                        while($data=mysqli_fetch_array($query)){
                ?>
                        <tr>
                            <td><?php echo $data['idusuario']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['correo']; ?></td>
                            <td><?php echo $data['usuario']; ?></td>
                            <td><?php echo $data['rol']; ?></td>
                            <td>
                                <a href="editar_usuario.php?id=<?php echo $data['idusuario']; ?>" class=btn_editar>Editar</a>
                                <?php
                                if($data['idusuario'] !=1){
                                ?>
                                <a href="eliminar_usuario.php?id=<?php echo $data['idusuario']; ?>" class=btn_eliminar>Eliminar</a>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                    }
                ?>
            </table>
            <?php 
            if($total_registro!=0){
            ?>
            <div class="paginador">
                <ul>
                    <?php
                    if($pagina != 1){
                    ?>
                    <li><a href="?pagina=<?php echo 1;?>&busqueda=<?php echo $busqueda;?>">|<</a></li>
                    <li><a href="?pagina=<?php echo $pagina-1;?>&busqueda=<?php echo $busqueda;?>"><<</a></li>
                    <?php
                    }
                    for($i=1;$i<=$total_paginas;$i++){
                        if($i==$pagina){
                            echo '<li class="pageSelected">'.$i.'</lo>';
                        }else{
                            echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
                        }
                    }
                    if($pagina != $total_paginas){
                    ?>  
                    <li><a href="?pagina=<?php echo $pagina+1;?>&busqueda=<?php echo $busqueda;?>">>></a></li>
                    <li><a href="?pagina=<?php echo $total_paginas;?>&busqueda=<?php echo $busqueda;?>">>|</a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php }?>
		</section>
	<?php include './includes/footer.php'; ?>
</body>
</html>