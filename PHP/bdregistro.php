<?php
include('Conexion.php');
include('Funciones.php');

$Nom = filter_var($_POST['Nom'],FILTER_SANITIZE_STRING);
$Correo = filter_var($_POST['Correo'],FILTER_SANITIZE_STRING);
$Telefono = filter_var($_POST['Tel'],FILTER_SANITIZE_STRING);
$Direccion = filter_var($_POST['Dir'],FILTER_SANITIZE_STRING);
$Contrasena = filter_var($_POST['Password'],FILTER_SANITIZE_STRING);



if(vacio($Nom) && vacio($Correo) && vacio($Telefono) && vacio($Direccion) && vacio(Contrasena)){
	$Registrado = $conexion -> prepare("SELECT Nombre FROM Usuario WHERE Correo = ?; ");
	$Registrado -> bind_param("s", $Correo);
	if($Registrado -> execute()){
		$result = $Registrado -> get_result();
		$total = $result -> num_rows;
		if($total>0){
			echo'1';
		}else{
			$consulta = $conexion -> prepare("INSERT INTO Usuario (Nombre,Correo,Telefono,Direccion,Contrasena) VALUES (?,?,?,?,?)");
			$consulta -> bind_param("sssss",$Nom,$Correo,$Telefono,$Direccion,$Contrasena);
			if($consulta -> execute()){
				$mensaje = "Hola $Nom, Te registraste exitosamente a JoFa Store ventas online, ve y realiza una compra de algún producto de tu agrado.";
				if(enviarCorreo($Nom,'Registro',$mensaje,$Correo)){
					echo'2';
				}else{
					echo'3';
				}
			}else{
				echo'4';
			}
		}	
	}else{
		echo'4';
	}
}else{
	echo'5';
}

// 1: Este correo ya esta registrado
// 2: Correo enviado
// 3: Correo no enviado
// 4: No se ejuto la consulta
// 5: Algunos campos están vacio.
?>