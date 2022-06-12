<?php
    //Sesión no activa se redirecciona a login
    session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');
?><!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Cambiar</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/estilo.css">
  </head>
  <body class="cam">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
    <div class="cambiar">
      <img src="imagenes/login.png" class="logo" alt="logo">
      <h1>Cambiar Info.</h1>
      <form method="POST" action="cambiar-admin.php">
        <?php
            //Conectar al servidor Mysql y a la base de datos
            //include ("conexion.php");
            $conexion = conectar();
            //Sentencia de consulta SQL
            $sql = "SELECT * FROM usuario LEFT JOIN domicilio ON usuario.idu = domicilio.idu WHERE usuario.idu=".$_GET['id'];
            $result = $conexion->query($sql);
            
            if(!empty($result) && $result->num_rows > 0){
                $_SESSION['idu-act']=$_GET['id'];
                //Recorremos cada registro y obtenemos los valores
                //de las columnas especificadas
                while ($row = $result->fetch_assoc()){
        ?>
        <a  class="boton-link"  href="administrar.php">*Volver a Administrar*</a>
        <span>Tipo de usuario:</span>
        <select name="tipo" class="text">
          <option class="text" value="admin" <?php if($row['tipo']=="admin") echo "selected";?> >Administrador</option>
          <option class="text" value="normal" <?php if($row['tipo']=="normal") echo "selected";?> >Normal</option>
        </select>
        <!-- Nombre INPUT -->
        <span>Nombre</span>
        <input class="text" type="text" placeholder="Escriba su nombre" name="nombre" required value="<?php echo $row['nombre'];?>">
        <!-- Ape Pat INPUT -->
        <span>Apellido Paterno</span>
        <input class="text" type="text" placeholder="Escriba su apellido paterno" name="ape_pat" required value="<?php echo $row['ape_pat'];?>">
        <!-- Ape Mat INPUT -->
        <span>Apellido Materno</span>
        <input class="text" type="text" placeholder="Escriba su apellido materno" name="ape_mat" required value="<?php echo $row['ape_mat'];?>">
        <!-- Fecha INPUT -->
        <span>Fecha de nacimiento</span>
        <input class="text" type="date" name="fecha" required value="<?php echo $row['fecha'];?>">
        <!-- Tel INPUT -->
        <span>Teléfono</span>
        <input class="text" type="number" placeholder="Escriba su teléfono" name="telefono" required value="<?php echo $row['telefono'];?>">
        <!-- Email INPUT -->
        <span>Email</span>
        <input class="text" type="text" placeholder="Escriba su email" name="email" required value="<?php echo $row['email'];?>">
        <!-- Contraseña INPUT -->
        <span>Contraseña</span>
        <input class="password" type="password" placeholder="Escriba su contraseña" name="password" required value="<?php echo $row['password'];?>">
        <span>Gustos</span>
        <input class="text" type="text" placeholder="Opcional" name="gustos" value="<?php echo $row['gustos'];?>">
        <!-- Código Postal INPUT -->
        <span>Código Postal</span>
        <input class="text" type="number" placeholder="Escriba su cp" name="cp" required value="<?php echo $row['cp'];?>">
        <!-- Calle INPUT -->
        <span>Calle</span>
        <input class="text" type="text" placeholder="Escriba su calle" name="calle" required value="<?php echo $row['calle'];?>">
        <!-- No. Exterior INPUT -->
        <span>No. Exterior</span>
        <input class="text" type="number" placeholder="Escriba su no. ext." name="n_ext" required value="<?php echo $row['n_ext'];?>">
        <!-- No. Interior INPUT -->
        <span>No. Interior</span>
        <input class="text" type="number" placeholder="Escriba su no. int." name="n_int" required value="<?php echo $row['n_int'];?>">
        <!-- Colonia INPUT -->
        <span>Colonia</span>
        <input class="text" type="text" placeholder="Escriba su colonia" name="colonia" required value="<?php echo $row['colonia'];?>">
        <!-- Ciudad INPUT -->
        <span>Ciudad</span>
        <input class="text" type="text" placeholder="Escriba su ciudad" name="ciudad" required value="<?php echo $row['ciudad'];?>">
        <!-- Estado INPUT -->
        <span>Estado</span>
        <input class="text" type="text" placeholder="Escriba su estado" name="estado" required value="<?php echo $row['estado'];?>">
        <?php
                }
            }
        ?>
        <!-- Submit INPUT -->
        <input class="submit" type="submit" value="Guardar">
      </form>
    </div>
  </body>
</html>