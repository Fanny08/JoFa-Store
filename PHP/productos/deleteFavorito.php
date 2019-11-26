<?php
include('../Conexion.php');
include('../Funciones.php');

session_start();
if($_SESSION["inicio"]==false){
	echo'2';
}else{

	$id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);

	if(vacio($id)){
		$Inicio = $conexion -> prepare("DELETE FROM Favoritos WHERE idFavoritos = ? AND Usuario_idUsuario = ?"); //Buscamos al usuario y verificamos que el curp coincida con el usuario
		$Inicio -> bind_param("ii", $id, $_SESSION["idUsuario"]);
		if($Inicio -> execute()){
			echo'1';
		}else{
			echo'0';
		}
	}
}
?>