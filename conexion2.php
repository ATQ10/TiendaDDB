<?php
@session_start();
function conectar2(){
    //Parámetros de conexión
    $servername = "remote";
    $database = "tienda";
    $username = "root";
    $password = "";
    
    //Crear la conexión
    $conn = mysqli_connect($servername,$username,$password,$database);
    //Checar si se realizó la conexión
    if(!$conn){
        die("ERROR: La conexión no se realizó correctamente.". mysqli_connect_error());
    }
    $cbd = mysqli_select_db($conn,$database);
    if(!$cbd){
        die("ERROR DE CONEXIÓN CON LA BASE DE DATOS");
    }
    return($conn);
}
?>