<?php
define("DB_HOST","srv180.main-hosting.eu" ); 
define("DB_USER", "u544169841_jofastore"); 
define("DB_PASS", "jofastore"); 
define("DB_DATABASE", "u544169841_jofastore" ); 
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

if($conexion -> connect_errno){
    die("Error de conexión: " . $conexion->mysqli_connect_errno() . ", " . $conexion->connect_error());
	exit();
}
?>