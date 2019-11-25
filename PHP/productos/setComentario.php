<?php
include('../Conexion.php');
include('../Funciones.php');

session_start();
if($_SESSION["inicio"]==false){
	echo'2';
}else{

$id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);;

if(vacio($id)){
	$Inicio = $conexion -> prepare("SELECT idProductos FROM Productos WHERE idProductos = ?"); //Buscamos al usuario y verificamos que el curp coincida con el usuario
	$Inicio -> bind_param("i", $id); //Pasamos los parametros
	if($Inicio -> execute()){ //Ejecutamos la consulta
		$result = $Inicio -> get_result(); //Obtenemos los resultados de la consulta
		$total = $result -> num_rows; //Contamos registros tenemos con la consulta de arriba
		if($total == 1){ 
			$consulta = $conexion -> prepare("INSERT INTO Favoritos (Productos_idProductos,Usuario_idUsuario) VALUES (?,?)");
			$consulta -> bind_param("ii",$id,$_SESSION["idUsuario"]);
			if($consulta -> execute()){
				echo'1';
			}
		}else{
			echo'0';
		}
	}
}
}
?>