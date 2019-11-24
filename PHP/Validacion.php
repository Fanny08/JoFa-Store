<?php
include('Conexion.php');
include('Funciones.php');

//Recibimos las variables enviadas por ajax
$User = filter_var($_POST['Usuario'],FILTER_SANITIZE_STRING);
$Contra = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

//validamos que los campos que recibimos no esten vacios
if(vacio($User) && vacio($Contra)){
	$Inicio = $conexion -> prepare("SELECT idUsuario, Nombre, Correo, Telefono, Direccion, Contrasena FROM Usuario WHERE Correo = ? AND Contrasena = ? "); //Buscamos al usuario y verificamos que el curp coincida con el usuario
	$Inicio -> bind_param("ss", $User,$Contra); //Pasamos los parametros
	if($Inicio -> execute()){ //Ejecutamos la consulta
		$result = $Inicio -> get_result(); //Obtenemos los resultados de la consulta
		$total = $result -> num_rows; //Contamos registros tenemos con la consulta de arriba
		if($total == 0){ //Si tenemos 0 registros es porque no se encontraron registros con ese Correo y Contrasena
			echo'3';
		}else if($total == 1){ //Si solo obtenemos un resultado entonces obtenemos sus datos
			while ($fila = $result -> fetch_assoc()) {
				session_start(); //Iniciamos sesion
				$_SESSION["inicio"] = true; //marcamos la variable como iniciada
				$_SESSION["Nombre"] = $fila['Nombre']; //Le asignamos a la variable de sesion 'nombre' el valor de Nombre de la base de datos
				$_SESSION["Correo"] = $fila['Correo']; //Le asignamos a la variable de sesion 'Correo' el valor de Correo de la base de datos
				$_SESSION["Telefono"] = $fila['Telefono']; //Le asignamos a la variable de sesion 'Telefono' el valor de Telefono de la base de datos
				$_SESSION["Direccion"] = $fila['Direccion']; //Le asignamos a la variable de sesion 'Direccion' el valor del Direccion de la base de datos
				$_SESSION["Contrasena"] = $fila['Contrasena']; //Le asignamos a la variable de sesion 'Contrasena' el valor del Contrasena de la base de datos
				$_SESSION["idUsuario"] = $fila['idUsuario']; //Le asignamos a la variable de sesion 'Contrasena' el valor del Contrasena de la base de datos
				
				echo'5';
			}
		}else{
			echo'4';
		}
	}else{
		echo'2';
	}
}else{
	echo'1';
}

// 1: El campo usuario y contra estan vacios|
// 2: Error al ejecutar la consulta
// 3: No se encontro al usuario
// 4: Hay mas de 1 usuario con el mismo Usuario y curp
// 5: Todos los campos son correctos e iniciamos la sesión

?>