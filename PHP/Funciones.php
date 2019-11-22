<?php
function vacio($input){		
	$remplazado = str_replace(' ','',$input);
	if(strlen($remplazado)!=0){
		return true;
	}else{
		return false;
	}
}

function mayus($input){
	return strtoupper($input);
}

function curpValida($valor){
	$re = "/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/";
	$validado = preg_match($re, $valor);
	
	if(!$validado){
		return false;
	}
	
	$validado = [$valor, mb_substr($valor, 0, mb_strlen($valor)-1), mb_substr($valor, -1)];
    
	$diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
	$lngSuma      = 0.0;
	$lngDigito    = 0.0;
	
	for($i=0; $i<17; $i++){
		$lngSuma = $lngSuma + mb_strpos($diccionario, mb_substr($validado[1], $i, 1,'UTF-8')) * (18 - $i);
	}
	
	$lngDigito = 10 - $lngSuma % 10;
	
	if($lngDigito == 10){
		$lngDigito = 0;
	}
	
	if($validado[2] != $lngDigito){
		return false;
	}
	else{
		return true;
	}
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function enviarCorreo($usuario, $titulo, $mensaje, $correo)
{
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	$mail = new PHPMailer(true);                              	// Passing `true` enables exceptions
	try
	{
		//Server settings
		$mail->SMTPDebug = 0;
		$mail->isSMTP();                                    	// Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;                               	// Activar SMTP Autenticacion
		$mail->Username = 'encuestasonlineutfv19@gmail.com';
		$mail->Password = 'l2EAS67B9O';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;

		//Recipients
		$mail->setFrom('encuestasonlineutfv19@gmail.com', "Encuestas Online - $titulo");
		$mail->addAddress("$correo","$usuario");     // Correo a enviar

		//Content
		$mail->isHTML(true);                                  // Enviar el correo con formato HTML
		$mail->Subject = "$titulo";
		
		$cuerpo = "
		<html>
		<head>
			<style>
				.pagina {padding-top:30px; padding-bottom:30px; padding-left:50px; padding-right:50px; margin-left: 25%; margin-right: 25%; border: 1px solid gray;}
				.Titulo { padding-bottom:0px;  font-style: italic; font-size:40px;}
				.postTitulo {padding-top:10px; padding-bottom:10px; text-align: center; font-size:35px;}
				.contenido {padding-top:20px; padding-bottom:30px; }
				.subTitulo {font-style: italic; font-size:20px ;}
				.footer {padding-top:30px; padding-bottom:30px; padding-left:50px; margin-left: 25%; margin-right: 25%;  background-color: #691a30; color: #ffe}
				.footer a {color: #ffe}

				.tabla { width:100%;}
				.tabla td {background-color:white; border-color:white; padding-left:30px;padding-right:30px; padding-bottom: 20px;}
				.tabla tr .mensaje {padding-top: 15px; border:1px solid gray; width:100%;}
				
				@media screen and (max-width: 768px) {
					.pagina {padding-top:30px; padding-bottom:30px; padding-left:20px; padding-right:20px; margin-left: 0%; margin-right: 0%; border: 1px solid gray;}			
					.footer {padding-top:30px; padding-bottom:30px; padding-left:50px; padding-right:50px; margin-left: 0%; margin-right: 0%;  background-color: #691a30; color: #ffe; text-align:center;}
					
					.tabla td { background-color:white; border-color:white; padding-left:5px;padding-right:5px; padding-bottom: 5px;}
				}
			</style>
			<meta charset='UTF-8'>
			<script src='https://kit.fontawesome.com/bc217967e5.js'></script>
		</head>
		<body>
			<div class='pagina'>
				<div class='Titulo'><font color='#691a30'>Encuestas</font><font color='#691a30'>Online <i class='fas fa-clipboard-check'></i></font> <div class='subTitulo'>$usuario</div></div>
				<hr>
				<div class='postTitulo'>$titulo</div>
				<div class='contenido'>
					<table class='tabla'>
						<tr>
							<td class='mensaje'><h4>$mensaje</h4></td>
						</tr>
					</table>
				</div>
			</div>
			<div class='footer'>
				Iniciar Sesion en <a href='http://formulog.000webhostapp.com/'>Encuestas Online <i class='fas fa-clipboard-check'></i></a>
			</div>
		</body>

		</html>
		";
		
		
		$mail->Body    = "$cuerpo";
		$mail->AltBody = "Error code HTML";

		$mail->send();
		return true;
	}
	catch (Exception $e)
	{
		return false;
	}
}
?>