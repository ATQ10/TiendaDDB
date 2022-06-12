<?php
//No es el admin
@session_start();
if (@$_SESSION['tipo'] != "admin")
  header('Location: index.php');
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Codificación de caracteres -->
  <meta charset="utf-8">
  <title>Nuevo producto</title>
  <!-- Hoja de estilos-->
  <link rel="stylesheet" href="estilos/estilo.css">
</head>

<body class="reg">
  <?php
  //Implementación de header
  include("header.php");
  ?>
  <div class="registro">
    <img src="imagenes/nuevoproducto.jpg" class="logo" alt="logo">
    <h1>Dar de alta</h1>
    <form method="POST" action="registrar-producto.php" enctype="multipart/form-data">
      <a class="boton-link" href="productos.php">*Volver a Productos*</a>
      <span> Seleccione tipo de producto</span>
      <select name="categoria" class="text" required>
        <option class="text" value="">----------</option>
        <?php
        //Conectar al servidor Mysql y a la base de datos
        //include ("conexion.php");
        $conexion = conectar();
        //Sentencia de consulta SQL
        $sql = "SELECT * FROM `categoria`";
        $result = $conexion->query($sql);
        
        if (!empty($result) && $result->num_rows > 0) {
          //Recorremos cada registro y obtenemos los valores
          //de las columnas especificadas
          while ($row = $result->fetch_assoc()) {
        ?>
            <option class="text" value="<?php echo $row['idcat']; ?>"><?php echo $row['categoria']; ?></option>
        <?php
          }
        }
        ?>
      </select>
      <!-- Nombre INPUT -->
      <span>Nombre</span>
      <input class="text" type="text" placeholder="Escriba nombre" name="nombre" required>
      <!-- Descripcion INPUT -->
      <span>Descripción</span>
      <input class="text" type="text" placeholder="Escriba descripción" name="descripcion" required>
      <!-- Precio INPUT -->
      <span>Precio</span>
      <input class="text" type="number" placeholder="Escriba precio" name="precio" min="0" required>
      <!-- Existencia INPUT -->
      <span>Existencia</span>
      <input class="text" type="number" placeholder="Escriba existencia" name="existencia" min="0" required>
      <span>Agregar Imagen</span>
      <input class="text" type="file" name="archivo" />
      <!-- Submit INPUT -->
      <input class="submit" type="submit" value="Añadir">
    </form>
  </div>
</body>

</html>