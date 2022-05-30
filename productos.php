<?php
    //Sesión no activa se redirecciona a login
    session_start();
    if(@$_SESSION['tipo']!="admin")
        header('Location: login.php');
?>
<!DOCTYPE html>
<html>
  <head>
        <!-- Codificación de caracteres -->
        <meta charset="utf-8">
        <title>Productos</title>
        <!-- Hoja de estilos-->
        <link rel="stylesheet" href="estilos/estilo.css">
    </head>
    <body class="adm">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
        <div class="administrar">
          <img src="imagenes/adm-prod.png" class="logo" alt="logo">
          <h1>Administrar Productos</h1>
            <a class="boton-link" href="altas-producto.php">*Nuevo producto*</a>
            <a  class="boton-link"  href="categorias.php">*Administrar Categorias*</a>
          <table border="1" width="90%">
                <tr>
                    <td><strong>Cambios<strong/></td>
                    <td><strong>Bajas<strong/></td>                
                    <td><strong>Nombre<strong/></td>
                    <td><strong>Descripcion<strong/></td>
                    <td><strong>Precio<strong/></td>
                    <td><strong>Existencia<strong/></td>
                    <td><strong>Categoria<strong/></td>
                    <td><strong>Imagen<strong/></td>
                </tr>
            <?php
            //Conectar al servidor Mysql y a la base de datos
            //include ("conexion.php");
            $conexion = conectar();
            //Sentencia de consulta SQL
            $sql = "SELECT producto.idp, categoria.categoria, producto.nombre, producto.descripcion, producto.precio, producto.existencia, producto.promedio, producto.imagen  FROM producto LEFT JOIN categoria ON producto.idcat = categoria.idcat";
            $result = $conexion->query($sql);
            if(!empty($result) && $result->num_rows > 0){
                //Recorremos cada registro y obtenemos los valores
                //de las columnas especificadas
                while ($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td><a class="boton-link" href="cambiar-producto.php?id=<?=$row['idp'];?>">Editar</a></td>
                    <td><a class="boton-link" href="bajas-productos.php?id=<?=$row['idp'];?>">Eliminar</a></td>                
                    <td><?=$row['nombre'];?></td>
                    <td>
                        <textarea name="categoria" rows="3" cols="15" readonly><?=$row['descripcion'];?></textarea>
                    </td>
                    <td><?=$row['precio'];?></td>
                    <td><?=$row['existencia'];?></td>
                    <td>
                        <?=$row['categoria'];?>
                    </td>
                    <td><img src="imagenes/productos/<?=$row['imagen'];?>" height="60"></td>
                </tr>
            <?php
                }
            }
            ?>
        </table>
        </div>
  </body>
</html>