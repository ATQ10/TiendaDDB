<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Cambiar producto</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/estilo.css">
  </head>
  <body class="cam">
  <?php
    //Implementación de header
    include ("header.php");
    //No es el admin
    @session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');

    //Conectar al servidor Mysql y a la base de datos
    //include ("conexion.php");
    $conexion = conectar();
    //Sentencia de consulta SQL
    $sql = "SELECT * FROM producto LEFT JOIN categoria ON producto.idcat = categoria.idcat WHERE producto.idp=".$_GET['id'];
    $result = $conexion->query($sql);
    include ("conexion2.php");
        $conexion2 = conectar2();
        $conexion2->query($sql);
    if(!empty($result) && $result->num_rows > 0){
        //Recorremos cada registro y obtenemos los valores
        //de las columnas especificadas
        while ($row = $result->fetch_assoc()){
          $_SESSION['idc-act']=$row['idp'];
          $idcat=$row['idcat'];
          $nombre=$row['nombre'];
          $descripcion=$row['descripcion'];
          $precio=$row['precio'];
          $existencia=$row['existencia'];
          $promedio=$row['promedio'];
          $imagen=$row['imagen'];
          $categoria=$row['categoria'];
        }
    }
  ?>
    <div class="cambiar">
      <img src="imagenes/editarproducto.jpg" class="logo" alt="logo">
      <h1>Editar producto</h1>
      <form method="POST" action="cambiar-producto-admin.php" enctype="multipart/form-data">
        <a  class="boton-link"  href="productos.php">*Volver a Productos*</a>
        <span> Seleccione tipo de producto</span>
        <select name="categoria" class="text">
            <?php
            $sql = "SELECT * FROM `categoria`";
            $result = $conexion->query($sql);
           
            if(!empty($result) && $result->num_rows > 0){
                //Recorremos cada registro y obtenemos los valores
                //de las columnas especificadas
                while ($row = $result->fetch_assoc()){
            ?>
          <option class="text" value="<?php echo $row['idcat'];?>" <?php if($row['categoria']==$categoria) echo " selected";?> > <?php echo $row['categoria'];?> </option>
            <?php
                }
            }
            //echo mysqli_error($conexion2);
            ?>
        </select>
        <!-- Nombre INPUT -->
        <span>Nombre</span>
        <input class="text" type="text" placeholder="Escriba nombre" name="nombre" value="<?php echo $nombre;?>" required>
        <!-- Descripcion INPUT -->
        <span>Descripción</span>
        <input class="text" type="text" placeholder="Escriba descripción" name="descripcion" value="<?php echo $descripcion;?>" required>
        <!-- Precio INPUT -->
        <span>Precio</span>
        <input class="text" type="number" placeholder="Escriba precio" name="precio" value="<?php echo $precio;?>" min="0" required>
        <!-- Existencia INPUT -->
        <span>Existencia</span>
        <input class="text" type="number" placeholder="Escriba existencia" name="existencia" value="<?php echo $existencia;?>" min="0" required>
        <!-- Submit INPUT -->
        <span>Imagen actual</span>
        <center>
          <img src="<?php echo "imagenes/productos/".$imagen;?>" height="80">
        </center>
        <span>Editar Imagen</span>
        <input class="text" type="file" name="archivo" />
        <input class="submit" type="submit" value="Actualizar">
      </form>
    </div>
  </body>
</html>