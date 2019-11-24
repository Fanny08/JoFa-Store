<?php
include('../Conexion.php');
include('../Funciones.php');

session_start();
if($_SESSION["inicio"]==false){
	echo'2';
}else{

$consultaSQL = $conexion -> query("
	SELECT 
	Productos.Nombre, 
	Productos.Precio 
		FROM Productos,
		Favoritos 	
			WHERE Productos.idProductos = Favoritos.Productos_idProductos 
				AND Favoritos.Usuario_idUsuario = ".$_SESSION["idUsuario"]."
");

if($consultaSQL){
	
	$obj = new stdClass();

	while($raw = $consultaSQL -> fetch_assoc())
	{
		$idProducto = $raw['idProductos'];
		
		$obj -> productos[] =
		[
			"nombre" => $raw['Nombre'],
			"precio" => $raw['Precio']
		];		
	}
	
	echo json_encode($obj);			
}
}
?>