<?php
    //Sesión activa se redirecciona a index 
    session_start();
    if(@$_SESSION['autentificado']==TRUE && $_SESSION['tipo']=="normal")
        header('Location: index.php');
    //Extraer valor de variables
    $array = array_keys($_POST);
    foreach ($array as $post) {
    	$$post = $_POST[$post];
    	echo $_POST[$post];
    }
    //Contraseñas diferentes
    if($password!=$cpassword){
?>
    <script language="JavaScript">
    	window.alert("Las contraseñas no coinciden");
    	window.history.back();
	</script>	
<?php 
	}
	//Verificar si el usuario existe
	//Conectar al servidor Mysql y a la base de datos tienda
        include ("conexion.php");
        $conexion = conectar();
        if(!$conexion){
            echo 'ERROR';
        }else{
            //echo 'Conn ok';
        }
        //Sentencia de consulta SQL
	    $sql = "SELECT * FROM `usuario` WHERE `email`='".$email."'";
        $result = $conexion->query($sql);
		
        if(!empty($result) && $result->num_rows > 0){
?>
    <script language="JavaScript">
    	window.alert("Ya existe una cuenta con este email");
    	window.history.back();
	</script>	
<?php    
		exit(0);     	
        }else{
        	//reordenar fecha
        	//list($dia, $mes, $anio) = explode("/", $fecha);
        	//$fecha=$anio."-".$mes."-".$dia;
        	//Sentencia de consulta SQL
            if($tipo==NULL)
                $tipo="normal";
	        $sql = "INSERT INTO `usuario` (`idu`, `nombre`, `ape_pat`, `ape_mat`, `fecha`, `email`, `telefono`, `tipo`, `password`, `gustos`) VALUES (NULL, '".$nombre."', '".$ape_pat."', '".$ape_mat."', '".$fecha."', '".$email."', '".$telefono."', '".$tipo."', '".md5($password)."', '')";
	        $result = $conexion->query($sql);
			include ("conexion2.php");
        $conexion2 = conectar2();
        $conexion2->query($sql);
	        if($result){
	        	if(@$_SESSION['tipo']!="admin"){
?>
    <script language="JavaScript">
    	window.alert("Registro exitoso, ahora inicie sesión");
    	window.location="login.php";
	</script>	
<?php 	      
				}else{
?>
    <script language="JavaScript">
    	window.alert("Ususario dado de alta");
    	window.location="administrar.php";
	</script>	
<?php 	 		
				}  	
	        }else{
	        	echo mysqli_error($conexion);
?>
    <script language="JavaScript">
    	window.alert("Intente más tarde");
    	window.history.back();
	</script>	
<?php 	        	
	        }
        }
?>