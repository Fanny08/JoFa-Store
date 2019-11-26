<?php
include('../Conexion.php');
include('../Funciones.php');


$id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);

if(vacio($id)){
	$Inicio = $conexion -> prepare("SELECT Usuario.Nombre, Comentarios.Comentario FROM Usuario, Comentarios WHERE Comentarios.Productos_idProductos = ? AND Comentarios.Usuario_idUsuario = Usuario.idUsuario ORDER BY Comentarios.idComentarios DESC"); //Buscamos al usuario y verificamos que el curp coincida con el usuario
	$Inicio -> bind_param("i", $id); //Pasamos los parametros
	$obj = new stdClass();
	if($Inicio -> execute()){ //Ejecutamos la consulta
		$result = $Inicio -> get_result(); //Obtenemos los resultados de la consulta
		while ($raw = $result -> fetch_assoc()) {
			$obj -> comentarios[] =
			[
				"usuario" => $raw['Nombre'],
				"comentario" => $raw['Comentario']
			];	
		}
	}
	echo json_encode($obj);	
}
?>