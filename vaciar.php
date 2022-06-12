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
    //Conectar al servidor Mysql y a la base de datos
    include ("conexion.php");
    $conexion = conectar();
    $sql = "DELETE FROM carrito WHERE idu=".$_SESSION['idu'];
    //echo $sql;
    //Verifica y ejecuta consulta
    if ($conexion->query($sql) === TRUE){
        include ("conexion2.php");
        $conexion2 = conectar2();
        $conexion2->query($sql);
        echo "<script type=\"text/javascript\">alert(\"Carrito vaciado exitosamente\");</script>";
        echo "<script type=\"text/javascript\">window.location=\"carrito.php\";</script>";
    } else {
        //echo 'Error: '. $sql . '<br>'.$conexion->error;
        echo "<script type=\"text/javascript\">alert(\"Intente mas tarde\");</script>";
        echo "<script type=\"text/javascript\">window.history.back();</script>";
    }
    mysqli_close($conexion);
?>