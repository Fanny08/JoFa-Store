<?php
include('../Conexion.php');
include('../Funciones.php');

session_start();
if($_SESSION["inicio"] == false){
	echo'2';
}else{
	$Usuario = $_SESSION["Nombre"];
	$Correo = $_SESSION["Correo"];
	$Direccion = $_SESSION["Direccion"];
	$Telefono = $_SESSION["Telefono"];
	$consultaSQL = $conexion -> query("
	SELECT 
	Favoritos.idFavoritos,
	Productos.idProductos,
	Productos.Nombre, 
	Productos.Precio 
		FROM Productos,
		Favoritos 	
			WHERE Productos.idProductos = Favoritos.Productos_idProductos 
				AND Favoritos.Usuario_idUsuario = ".$_SESSION["idUsuario"]."
	");

	if($consultaSQL){

		$obj = new stdClass();
		$PVendidos = '';
		$Total = 0;

		while($raw = $consultaSQL -> fetch_assoc())
		{
			$idProducto = $raw['idProductos'];	
			$idFavorito = $raw['idFavoritos'];
			$getStock = $conexion -> query("
				SELECT 
				Stock
					FROM Productos	
						WHERE idProductos =  $idProducto
				");
			if($getStock){
				while($rew = $getStock -> fetch_assoc())
				{
					$Stock = $rew['Stock'];
					
					if($Stock>0){
						$newStock = $Stock-1;						
						$updateStock = $conexion -> query("
							UPDATE Productos SET Stock = $newStock 
							WHERE idProductos = $idProducto
							");	
						if($updateStock){
							$obj -> vendidos[] =
							[
								"nombre" => $raw['Nombre']
							];
							$PVendidos.=$raw['Nombre'].",";
							$Total+=$raw['Precio'];
							$deleteFav = $conexion -> query("
								DELETE FROM Favoritos WHERE idFavoritos = $idFavorito
								");							
						}
					}else{
						$obj -> faltantes[] =
						[
							"nombre" => $raw['Nombre']
						];
					}
				}
			}

		}	
		 $mensaje = "Hola $Usuario, Tu compra es: $PVendidos, el total de la compra es: $Total <br> Realiza tu pago en oxxo a este numero de cuenta 5514 8520 1690 2605 lo más pronto posible.";
						if(enviarCorreo($Usuario,'Datos de pago',$mensaje,$Correo)){
							$obj -> status[] =
							[
								"code" => 3
							];
						}else{
							$obj -> status[] =
							[
								"code" => 2
							];
						}
		echo json_encode($obj);	
	}
}
?>