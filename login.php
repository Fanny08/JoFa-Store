<!DOCTYPE html>
<html lang="es">

	<head>
		<title>JoFa Store</title>
			<?php
			include('html-source/head.html');
			?>
	</head>
	
	<body>
	<?php
		include('html-source/menu.php');
	?>
		<div class="container">
			<div class="col-md-12 mt-5"></div>
			<div class="row mt-5">
				<form action="#" class="form-3d shadow-lg p-3 mb-5 bg-white rounded" method="post" id="login">
					<div class="field correo">
						<div class="icon" style="background: url(https://image.flaticon.com/icons/svg/131/131040.svg) center/contain no-repeat;"></div>
						<input class="input" id="correo" type="email" placeholder="Correo" autocomplete="off" required />
					</div>
					<div class="field contraseña">
						<div class="icon" style="background: url(https://image.flaticon.com/icons/svg/130/130996.svg) center/contain no-repeat;"></div>
						<input class="input" id="contraseña" type="password" placeholder="Contraseña" required />
					</div>
					<button class="button" id="submit">Entrar
						<div class="side-top-bottom"></div>
						<div class="side-left-right"></div>
					</button>
					<small><a href="registro.php">Registrarse</a></small>
				</form>
			</div>
		</div>
<script src="JS/form-3d.js"></script>
<script>
jQuery(document).ready(function(){
	$("#login").submit(function () {
		var Correo = $('#correo').val();
		var Contra = $('#contraseña').val();
		var Parametros = {
			'Usuario':Correo,
			'password':Contra
		};
		$.ajax({
			data:Parametros,
			url:"PHP/Validacion.php",
			type:"post",
			success:function(datos){
				if(datos==1){
				swal("Error","Algunos campos esta vacios.","error");
				}else if(datos==2){
					swal("Error", "Error al ejecutar la consulta.", "error");
				}else if(datos==3){
					swal("Error", "Verifica que tu usuario o contraseña sean correctas.", "error");
				}else if(datos==4){
					swal("Error", "Existen mas de 1 usuario con tus mismos datos.", "error");
				}else if(datos==5){
					location.href = "Comprador/productos.php";					
				}else{
					swal("Error al inciar sesión: ", datos, "warning");
				}
			}
		});
		return false;
	});
});
</script>
<script>
$("#menu-reg").remove();
$("#menu-ing").remove();
</script>
</body>
</html>