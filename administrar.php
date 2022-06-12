<?php
//Sesión no activa se redirecciona a login
@session_start();
if (@$_SESSION['tipo'] != "admin")
  header('Location: login.php');
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Codificación de caracteres -->
  <meta charset="utf-8">
  <title>Administrar</title>
  <!-- Hoja de estilos-->
  <link rel="stylesheet" href="estilos/estilo.css">
</head>

<body class="adm">
  <?php
  //Implementación de header
  include("header.php");
  ?>
  <div class="administrar">
    <img src="imagenes/admin.jpg" class="logo" alt="logo">
    <h1>Administrar</h1>
    <a class="boton-link" href="altas.php">*Nuevo usuario*</a>
    <table border="1" width="90%">
      <tr>
        <td><strong>Cambios<strong /></td>
        <td><strong>Bajas<strong /></td>
        <td><strong>Tipo<strong /></td>
        <td><strong>Nombre<strong /></td>
        <td><strong>Ape. Pat.<strong /></td>
        <td><strong>Ape. Mat.<strong /></td>
        <td><strong>Fecha<strong /></td>
        <td><strong>Teléfono<strong /></td>
        <td><strong>Email<strong /></td>
        <td><strong>C.P.<strong /></td>
        <td><strong>Calle<strong /></td>
        <td><strong>No. Ext<strong /></td>
        <td><strong>No. Int<strong /></td>
      </tr>
      <?php
      //Conectar al servidor Mysql y a la base de datos
      //include ("conexion.php");
      $conexion = conectar();
      //Sentencia de consulta SQL
      $sql = "SELECT usuario.idu, usuario.tipo, usuario.nombre, usuario.ape_pat, usuario.ape_mat, usuario.fecha, usuario.telefono, usuario.email, domicilio.cp, domicilio.calle, domicilio.n_ext, domicilio.n_int FROM usuario LEFT JOIN domicilio ON usuario.idu = domicilio.idu ORDER BY usuario.tipo, usuario.idu";
      $result = $conexion->query($sql);
      if (!empty($result) && $result->num_rows > 0) {
        //Recorremos cada registro y obtenemos los valores
        //de las columnas especificadas
        while ($row = $result->fetch_assoc()) {
      ?>
          <tr>
            <td><a class="boton-link" href="cambiar.php?id=<?= $row['idu']; ?>">Editar</a></td>
            <td><a class="boton-link" href="bajas.php?id=<?= $row['idu']; ?>">Eliminar</a></td>
            <td><?= $row['tipo']; ?></td>
            <td><?= $row['nombre']; ?></td>
            <td><?= $row['ape_pat']; ?></td>
            <td><?= $row['ape_mat']; ?></td>
            <td><?= $row['fecha']; ?></td>
            <td><?= $row['telefono']; ?></td>
            <td><a class="boton-link" href="chat.php?chat=<?= $row['idu']; ?>"><?= $row['email']; ?></a></td>
            <td><?= $row['cp']; ?></td>
            <td><?= $row['calle']; ?></td>
            <td><?= $row['n_ext']; ?></td>
            <td><?= $row['n_int']; ?></td>
          </tr>
      <?php
        }
      }
      ?>
    </table>
  </div>
</body>

</html>