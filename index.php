<?php
    //Sesión no activa se redirecciona a login
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Inicio</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/font-awesome.min.css">
    <link rel="stylesheet" href="estilos/estilo.css"> 
  </head>
  <body class="ind">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
    <div class="index">
      <table class="listado" border="0" align="center" width="70%">
        <tr>
          <td colspan="2">
            <center>
              <H1>Productos</H1>
            </center>
          </td>
        </tr>
<?php
    //Conectar al servidor Mysql y a la base de datos
    //include ("conexion.php");
    $conexion = conectar();
    //Sentencia de consulta SQL
    
    if(@$_GET['categoria']!=0)
    {
      if(@$_GET['buscar']=="")
        $sql = "SELECT * FROM producto WHERE idcat=".@$_GET['categoria']."";
      else
        $sql = "SELECT * FROM producto WHERE idcat='".@$_GET['categoria']."' AND  CONCAT(' ' , descripcion , ' ' , nombre , ' ' )  LIKE '%".@$_GET['buscar']."%'";
    }else{
      if(@$_GET['buscar']=="")
        $sql = "SELECT * FROM producto";
      else
        $sql = "SELECT * FROM producto WHERE CONCAT(' ' , descripcion , ' ' , nombre , ' ' ) LIKE '%".@$_GET['buscar']."%'";
    }
    $result = $conexion->query($sql);
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
?>
        <tr>
          <td colspan="2">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>
        <tr>
          <td>
            <center>
              <img class="efecto" src="<?php echo "imagenes/productos/".$row['imagen'];?>" width="300">
            </center>
          </td>
          <td>
            <span class="titulo"><STRONG>Nombre:</STRONG></span><br>
            <span class="contenido"><?php echo $row['nombre'];?></span><br>
            <span class="titulo"><STRONG>Precio:</STRONG></span><br>
            <span class="contenido"><?php echo "$".$row['precio']." MXN";?></span>
            <br>
            <br>
            <a class="boton-link2" href="articulo.php?id=<?php echo $row['idp'];?>"><STRONG>Detalles</STRONG></span><br>
          </td>
        </tr>

<?php
        }
    }else{    
?>        
        <tr>
          <td colspan="2">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <span class="titulo"><STRONG><center>No se encontraron resultados</center></STRONG></span><br>
          </td>
        </tr>
<?php
    }
?>
      </table>
    </div>
  <?php
    //Implementación de footer
    include ("footer.php");
  ?>
  </body>
</html>