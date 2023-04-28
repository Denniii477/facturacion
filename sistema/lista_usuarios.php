<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include './includes/scripts.php'; ?>
		<title>Lista de Usuarios</title>
</head>
<body>
	<?php include './includes/header.php'; 
          include './includes/list_user.php';?>
		<section id="container">
			<h1>Lista de Usuarios</h1>
            <a href="registro_usuarios.php" class="btn_new">Crear Usuarios</a>
            <!-- Buscador -->
            <form action="user_search.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
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

                    $query= mysqli_query($conection, 
                        "SELECT u.idusuario,
                                u.nombre,
                                u.correo,
                                u.usuario,
                                r.rol
                           FROM usuario u
                     INNER JOIN rol r
                             ON u.rol=r.idrol
                          WHERE estatus = 1
                       ORDER BY u.idusuario
                      ASC LIMIT $desde,$por_pagina");//cambiar de 0 a 1 de estatus para mostrar los borrados//
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
            <!--div class="paginador">
            <nav-- class="pagination" role="navigation" aria-label="pagination">
                <a class="pagination-previous is-disabled" title="This is the first page">Anterior</a>
                <a class="pagination-next">Siguiente</a>
                <ul class="pagination-list">
                    <li>
                    <a class="pagination-link is-current" aria-label="Page 1" aria-current="page">1</a>
                    </li>
                    <li>
                    <a class="pagination-link" aria-label="Goto page 2">2</a>
                    </li>
                    <li>
                    <a class="pagination-link" aria-label="Goto page 3">3</a>
                    </li>
                </ul>
                </nav-->
            <div class="paginador">
                <ul>
                    <?php
                    if($pagina != 1){
                    ?>
                    <li><a href="?pagina=<?php echo 1;?>">|<</a></li>
                    <li><a href="?pagina=<?php echo $pagina-1;?>"><<</a></li>
                    <?php
                    }
                    for($i=1;$i<=$total_paginas;$i++){
                        if($i==$pagina){
                            echo '<li class="pageSelected">'.$i.'</lo>';
                        }else{
                            echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                        }
                    }
                    if($pagina != $total_paginas){
                    ?>  
                    <li><a href="?pagina=<?php echo $pagina+1;?>">>></a></li>
                    <li><a href="?pagina=<?php echo $total_paginas;?>">>|</a></li>
                    <?php } ?>
                </ul>
            </!--div>
		</section>
	<?php include './includes/footer.php'; ?>
</body>
</html>