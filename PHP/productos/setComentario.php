<?php
include('../Conexion.php');
include('../Funciones.php');

session_start();
if($_SESSION["inicio"]==false){
	echo'2';
}else{

	$id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
	$comentario = filter_var($_POST['comentario'],FILTER_SANITIZE_STRING);

	if(vacio($id) && vacio($comentario)){
		$Inicio = $conexion -> prepare("INSERT INTO Comentarios (Productos_idProductos,Usuario_idUsuario,Comentario) VALUES (?,?,?)"); //Buscamos al usuario y verificamos que el curp coincida con el usuario
		$Inicio -> bind_param("iis", $id, $_SESSION["idUsuario"], $comentario);
		if($Inicio -> execute()){
			echo'1';
		}else{
			echo'0';
		}
	}
}
?>