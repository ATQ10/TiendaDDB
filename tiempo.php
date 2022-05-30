<?php @SESSION_START();
	if ($_SESSION['idu']=='') {
	echo "<script>location.href='index.php'</script>";	
	exit(0);
	}
$mysqli = new mysqli("localhost", "id15733014_user", "pawgVwKXxNv}95(h", "id15733014_tienda");
/* comprueba la conexión */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
/* devuelve el nombre de la base de datos actualmente seleccionada */
//if($_SESSION['tipo']=="normal")
if ($result = $mysqli->query("SELECT * FROM `mensaje`
 WHERE `idu` = ".$_SESSION['chat']." ORDER BY `mensaje`.`idm` DESC")) {
    while($row = $result->fetch_row()){
    	if($row[4]==0){
    		printf("<p><div class=\"left\"><span class=\"mensaje\">%s</span><br><span class=\"fecha\">%s</span></div></p>", $row[2], $row[3]);
    	}
    	else{
    		printf("<p><div align=\"right\"><div class=\"right\"><span class=\"mensaje\">%s</span><br><span class=\"fecha\">%s</span></div></div></p>", $row[2], $row[3]);
    	}
	}
    $result->close();
}
$mysqli->close();
?>