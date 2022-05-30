<?php
    //Sesión no activa se redirecciona a login
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Artículo</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/font-awesome.min.css">
    <link rel="stylesheet" href="estilos/estilo.css">
    <!-- JS-->
    <script>
        function enviar(id){
            var comentario = document.getElementById('comentario').value;
            if(comentario!="")
                window.location="comentar.php?id="+id+"&comentario="+comentario;
            else
                alert("Agrega un comentario");
        }
        function agregar(id,total){
            var cantidad = document.getElementById('cantidad').value;
            if(total==0)
                alert("Producto agotado");
            else if(cantidad<=total)
                window.location="agregar.php?id="+id+"&cantidad="+cantidad;
            else
              alert("Seleccione otra cantidad");
        }
    </script>
  </head>
  <body class="ind">
  <?php
    //Implementación de header
    include ("header.php");
    //Conectar al servidor Mysql y a la base de datos
    //include ("conexion.php");
    $conexion = conectar();
    //Sentencia de consulta SQL
    $sql = "SELECT * FROM producto LEFT JOIN categoria ON producto.idcat = categoria.idcat WHERE producto.idp=".$_GET['id'];
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
          $categoria=$row['categoria'];
        }
    }
?>
    <div class="index">
      <table class="listado" border="0" align="center" width="70%">
        <tr>
          <td colspan="2">
            <center>
              <H1><?php echo $nombre;?></H1>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>
        <tr>
          <td>
            <center>
              <img class="efecto" src="<?php echo "imagenes/productos/".$imagen;?>" width="300">
            </center>
          </td>
          <td>
            <span class="titulo"><STRONG>Categoría:</STRONG></span><br>
            <span class="contenido"><?php echo $categoria;?></span><br>
            <span class="titulo"><STRONG>Nombre:</STRONG></span><br>
            <span class="contenido"><?php echo $nombre;?></span><br>
            <span class="titulo"><STRONG>Descripcipción:</STRONG></span><br>
            <span class="contenido"><?php echo $descripcion;?></span><br>
            <span class="titulo"><STRONG>Precio:</STRONG></span><br>
            <span class="contenido"><?php echo "$".$precio." MXN";?></span><br><br>
            <span class="titulo"><STRONG><?php echo $existencia." disponibles";?></STRONG></span><br>
          </td>
        </tr>
        <tr>
          <td>
            <center>
            </center>
          </td>
          <td>
            
          </td>
        </tr>
        <tr>
          <td>
            <center>
            <span class="contenido"><STRONG>Comentar: </STRONG></span><br>
            <textarea id="comentario" rows="5" cols="40" maxlength="250" name="comentario"  placeholder="Agregue un comentario"></textarea>
            <br>
            <button onclick="enviar(<?php echo $_GET['id'];?>);"  class="boton-link2">
              <STRONG>Enviar</STRONG>
            </button>
            </center>
          </td>
          <td>
            <center>
            <span class="titulo"><STRONG>Cantidad: </STRONG></span>
            <input class="contenido" id="cantidad" type="number" name="cantidad" size="30" value="1" min="1" max="<?php echo $existencia;?>">
            <button onclick="agregar(<?php echo $_GET['id'];?>,<?php echo $existencia;?>);" class="boton-link2" href="articulo.php?id=<?php echo $row['idp'];?>"><STRONG>Agregar</STRONG></button>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <center>
            <span class="titulo"><STRONG>Sección de comentarios</STRONG></span>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>

        <tr>
          <td width="50%">
            <center>
            <span class="contenido"><STRONG>Usuario</STRONG></span>
            </center>
          </td>
          <td width="50%">
            <center>
            <span class="contenido"><STRONG>Comentario</STRONG></span>
            </center>
          </td>
        </tr>
<?php
    //Conectar al servidor Mysql y a la base de datos
    //include ("conexion.php");
    $conexion = conectar();
    //Sentencia de consulta SQL
    $result=0;
    $sql = "SELECT comentar.*,usuario.nombre,usuario.ape_pat,usuario.ape_mat FROM comentar LEFT JOIN usuario ON usuario.idu = comentar.idu WHERE comentar.idp=".$_GET['id'];
    $result = $conexion->query($sql);
    if(!empty($result) && $result->num_rows > 0){
        //Recorremos cada registro y obtenemos los valores
        //de las columnas especificadas
        while ($row = $result->fetch_assoc()){
?>
        <tr>
          <td width="50%">
            <center>
            <img src="imagenes/iconocool.png" width="100px" height="100px"><br>
            <span class="contenido"><?php echo $row['nombre']." ".$row['ape_pat']." ".$row['ape_mat'];?></span><br>
            <span class="contenido">Con fecha de: <?php echo $row['fecha_hora'];?></span><br>
            </center>
          </td>
          <td width="50%">
            <center>
            <span class="contenido"><?php echo $row['nombre']." dice:";?></span><br>
            <span>
              <blockquote>"<?php echo $row['comentario'];?>"</blockquote><br>
            </center>
            </span>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>

<?php
        }
    }else{    
?>        
        <tr>
          <td colspan="2">
            <span class="contenido"><STRONG><center>Sin comentarios (Se el primero en comentar)</center></STRONG></span><br>
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