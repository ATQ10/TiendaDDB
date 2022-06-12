<?php
    //Sesión activa se redirecciona a la seccion anterior 
    session_start();
    if(@$_SESSION['tipo']==""){
        ?>
    <script language="JavaScript">
        window.alert("Primero debe identificarse");
        window.history.back();
    </script>   
<?php   
    exit(0);
    }
    if(@$_SESSION['cp']==""){
?>
    <script language="JavaScript">
        window.alert("Agregue un domicilio");
        echo "<script type=\"text/javascript\">window.location=\"domicilio.php\";</script>";
    </script>
<?php
    exit(0);
    }else{
        @$cantidad=$_POST['cantidad'];
        @$item=$_POST['item'];
        //echo @count($item);
        $can=0;
        $can=@count($item);
        if (@count($item)==0) {
        ?>
        <script language="JavaScript">
            window.alert("No ha seleccionado nada para comprar");
            window.history.back();
        </script>   
        <?php  exit(0);
    }
    //Conectar al servidor Mysql y a la base de datos
    include ("conexion.php");
    $conexion = conectar();
    //Extraemos la tabla productos (id y existancia)
    $sql = "SELECT idp,existencia,precio,nombre FROM `producto`";
    $result = $conexion->query($sql);
    $total=0;
    if(!empty($result) && $result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $nuevaExistencia[$row['idp']]=$row['existencia'];
            for($i=0;$i<@count($item);$i++){
                if($row['idp']==$item[$i]){
                    $total+=$cantidad[$i]*$row['precio'];
                    $precio[$i]=$row['precio'];
                    $nombre[$i]=$row['nombre'];
                }
            }
        }
    }
    //Actualizamos valores
    include ("conexion2.php");
        for($i=0;$i<@count($item);$i++){
            if($item[$i]!=""){
                $nuevaExistencia[$item[$i]]-=$cantidad[$i];
                $sql = "UPDATE `producto` SET `existencia` = '".$nuevaExistencia[$item[$i]]."' WHERE `producto`.`idp` = ".$item[$i];
                $conexion->query($sql);
                
        $conexion2 = conectar2();
        $conexion2->query($sql);
            }
        }
    //Insertamos nueva compra    
    date_default_timezone_set('America/Mexico_City');
    $fecha=date("Y-m-d H:i:s");
     $sql = "INSERT INTO `compra` (`idc`, `idu`, `monto`, `cantidad`, `fecha_hora`) VALUES (NULL, '".$_SESSION['idu']."', '".$total."', '".$can."', '".$fecha."');";
     $conexion->query($sql);
        $conexion2->query($sql);
     
    //Extraemos id de la compra
     $sql = "SELECT idc FROM compra WHERE fecha_hora='".$fecha."'";
     $result = $conexion->query($sql);
    if(!empty($result) && $result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $idCompra=$row['idc'];
        }
    }

    //Registramos productos en contener
    for($i=0;$i<@count($item);$i++){
        $sql = "INSERT INTO `contener` (`idc`, `idp`, `cantidad`) VALUES ('".$idCompra."', '".$item[$i]."', '".$cantidad[$i]."');";
        $conexion->query($sql);
        $conexion2->query($sql);
    }
    //Vaciamos carrito   
    $sql = "DELETE FROM carrito WHERE idu=".$_SESSION['idu'];
    //echo $sql;
    //Verifica y ejecuta consulta
    if ($conexion->query($sql) === TRUE){
        $conexion2->query($sql);
        echo "<script type=\"text/javascript\">alert(\"Venta exitosa, a continuación recibirá un correo electrónico.\");</script>";

        //Preparamos mensaje;
        $_SESSION['mensaje']='<meta charset="UTF-8"><meta http-equiv="Content-Type">
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <h1>Cliente distinguido</h1>
  <p><strong>* Sus datos son: </strong></p>
  <p><strong> 1) Nombre de usuario: [</strong>'.$_SESSION['nombre'].' '.$_SESSION['ape_pat'].$_SESSION['ape_mat'].'<strong>]</strong></p>
  <p><strong> 2) Teléfono: [</strong>'.$_SESSION['telefono'].'<strong>]</strong></p>
  <p><strong> 3) Email: [</strong>'.$_SESSION['email'].'<strong>]</strong></p>
  <p><strong> 4) C.P.: [</strong>'.$_SESSION['cp'].'<strong>]</strong></p>
  <p><strong> 5) Calle: [</strong>'.$_SESSION['calle'].'<strong>]</strong></p>
  <p><strong> 6) No. Ext.: [</strong>'.$_SESSION['n_ext'].'<strong>]</strong></p>
  <p><strong> 7) N. Int.: [</strong>'.$_SESSION['n_int'].'<strong>]</strong></p>
  <p><strong> 8) Colonia: [</strong>'.$_SESSION['colonia'].'<strong>]</strong></p>
  <p><strong> 9) Ciudad: [</strong>'.$_SESSION['ciudad'].'<strong>]</strong></p>
  <p><strong> 10) Estado: [</strong>'.$_SESSION['estado'].'<strong>]</strong></p>
  <p><strong>- - - - - - - - - - - </strong></p>
  <p><strong>* Detalles de compra: '.count($item).' artículos </strong></p><ol>';
  $cadena='';
    for($i=0;$i<@count($item);$i++){
         $cadena.='<li>('.$cantidad[$i].' '.$nombre[$i].' de $'.$precio[$i].' c/u)</li>';
    }
    $_SESSION['mensaje']=$_SESSION['mensaje'].$cadena.'</ol><p><strong>- - - - - - - - - - - </strong></p>
    <strong> Total a pagar: $'.$total.'</strong><p>Si usted desconoce este movimiento, ignore este correo, puesto que se trata de un error</p>
</div>';
    echo $_SESSION['mensaje'];

     echo "<script type=\"text/javascript\">window.location=\"PHPMailer/examples/gmail.php\";</script>";
    } else {
        //echo 'Error: '. $sql . '<br>'.$conexion->error;
        echo "<script type=\"text/javascript\">alert(\"Intente mas tarde\");</script>";
        echo "<script type=\"text/javascript\">window.history.back();</script>";
    } 
        mysqli_close($conexion);
    }
?>