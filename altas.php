<?php
    //No es el admin
    session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Altas</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/estilo.css">
  </head>
  <body class="reg">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
    <div class="registro">
      <img src="imagenes/login.png" class="logo" alt="logo">
      <h1>Dar de alta</h1>
      <form method="POST" action="registrar.php">
        <a  class="boton-link"  href="administrar.php">*Volver a Administrar*</a>
        <span>Tipo de usuario:</span>
        <select name="tipo" class="text">
          <option class="text" value="admin">Administrador</option>
          <option class="text" value="normal" selected>Normal</option>
        </select>
        <!-- Nombre INPUT -->
        <span>Nombre</span>
        <input class="text" type="text" placeholder="Escriba nombre" name="nombre" required>
        <!-- Ape Pat INPUT -->
        <span>Apellido Paterno</span>
        <input class="text" type="text" placeholder="Escriba apellido paterno" name="ape_pat" required>
        <!-- Ape Mat INPUT -->
        <span>Apellido Materno</span>
        <input class="text" type="text" placeholder="Escriba apellido materno" name="ape_mat" required>
        <!-- Fecha INPUT -->
        <span>Fecha de nacimiento</span>
        <input class="text" type="date" name="fecha" required>
        <!-- Tel INPUT -->
        <span>Teléfono</span>
        <input class="text" type="number" placeholder="Escriba teléfono" name="telefono" required>
        <!-- Email INPUT -->
        <span>Email</span>
        <input class="text" type="text" placeholder="Escriba email" name="email" required>
        <!-- Contraseña INPUT -->
        <span>Contraseña</span>
        <input class="password" type="password" placeholder="Escriba contraseña" name="password" required>
        <!-- Contraseña INPUT -->
        <span>Confirmar contraseña</span>
        <input class="password" type="password" placeholder="Confirme contraseña" name="cpassword" required>
        <!-- Submit INPUT -->
        <input class="submit" type="submit" value="Añadir">
      </form>
    </div>
  </body>
</html>