<?php
    //Sesión activa se redirecciona a index
    session_start();
    if(@$_SESSION['autentificado']==TRUE)
        header('Location: index.php');
    else{
        //Conectar al servidor Mysql y a la base de datos foro
        include ("conexion.php");
        $conexion = conectar();
        if(!$conexion){
            echo 'ERROR';
        }else{
            //echo 'Conn ok';
        }
        //Sentencia de consulta SQL
        $sql = "SELECT * FROM `usuario` WHERE `email`='".$_POST['email']."'";
        $result = $conexion->query($sql);
        
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                //verificamos contraseña encriptada en md5
                if($row["password"]== md5($_POST['password'])){
                    //Guardamos info en variables de sesión
                    $_SESSION['autentificado']=TRUE;
                    $_SESSION['idu']=$row["idu"];
                    $_SESSION['nombre']=$row["nombre"];
                    $_SESSION['ape_pat']=$row["ape_pat"];
                    $_SESSION['ape_mat']=$row["ape_mat"];
                    $_SESSION['fecha']=$row["fecha"];
                    $_SESSION['email']=$row["email"];
                    $_SESSION['telefono']=$row["telefono"];
                    $_SESSION['tipo']=$row["tipo"];
                    $_SESSION['password']=$_POST['password'];
                    $_SESSION['gustos']=$row['gustos'];
                    verificarDomicilio();
                    echo "<script type=\"text/javascript\">alert(\"Bienvenid@\");</script>";
                    echo "<script type=\"text/javascript\">window.location=\"index.php\";</script>";
                }else{
                    //Contraseña incorrecta
                    echo "<script type=\"text/javascript\">alert(\"Contraseña incorrecta\");</script>";
                    echo "<script type=\"text/javascript\">window.history.back();</script>";
                }
            }
        } else {
            //No existe usuario
            echo "<script type=\"text/javascript\">alert(\"No existe usuario\");</script>";
            echo "<script type=\"text/javascript\">window.history.back();</script>";
        }
        mysqli_close($conexion);
    }

    function verificarDomicilio(){
        $conexion = conectar();
        if(!$conexion){
            echo 'ERROR';
        }else{
            //echo 'Conn ok';
        }
        //Sentencia de consulta SQL
        $sql = "SELECT * FROM `domicilio` WHERE `idu`='".$_SESSION['idu']."'";
        $result = $conexion->query($sql);
        
        if($result->num_rows > 0){
             while ($row = $result->fetch_assoc()){
                $_SESSION['cp']=$row["cp"];
                $_SESSION['calle']=$row["calle"];
                $_SESSION['n_ext']=$row["n_ext"];
                $_SESSION['n_int']=$row["n_int"];
                $_SESSION['colonia']=$row["colonia"];
                $_SESSION['ciudad']=$row["ciudad"];
                $_SESSION['estado']=$row["estado"];
             }
        }
        else{
            $sql = "INSERT INTO `domicilio` (`idu`, `cp`, `calle`, `n_ext`, `n_int`, `colonia`, `ciudad`, `estado`) VALUES ('".$_SESSION['idu']."', '', NULL, '', '', NULL, NULL, NULL)";
            $result = $conexion->query($sql);
            include ("conexion2.php");
        $conexion2 = conectar2();
        $conexion2->query($sql);
            /*
            if($result)
                    echo "<script type=\"text/javascript\">alert(\"Generado\");</script>";
            else
                    echo "<script type=\"text/javascript\">alert(\"".mysqli_error($conexion)."\");</script>";
            */
            $_SESSION['cp']="";
            $_SESSION['calle']="";
            $_SESSION['n_ext']="";
            $_SESSION['n_int']="";
            $_SESSION['colonia']="";
            $_SESSION['ciudad']="";
            $_SESSION['estado']="";
        }
        mysqli_close($conexion);
    }
?>