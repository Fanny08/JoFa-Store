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
		include('html-source/preloader.html');
	?>	
	
	<?php
		include('html-source/menu.php');
	?>
		<div class="container">
			<div class="col-md-12 mt-5"></div>
			<div class="row mt-5">
				<form action="#" class="form-3d shadow-lg p-3 mb-5 bg-white rounded" method="post" id="registro">
					<div class="field nombre">
						<div class="icon" style="background: url(https://image.flaticon.com/icons/svg/131/131040.svg) center/contain no-repeat;"></div>
						<input class="input" id="Nombre" type="text" placeholder="Nombre Completo" required />
					</div>
					<div class="field correo">
						<div class="icon" style="background: url(https://image.flaticon.com/icons/svg/1361/1361722.svg) center/contain no-repeat;"></div>
						<input class="input" id="Correo" type="email" placeholder="Correo" required />
					</div>
					<div class="field telefono">
						<div class="icon" style="background: url(https://image.flaticon.com/icons/svg/82/82265.svg) center/contain no-repeat;"></div>
						<input class="input" id="Tel" type="text" placeholder="Telefono" required />
					</div>
					<div class="field direccion">
						<div class="icon" style="background: url(https://image.flaticon.com/icons/svg/854/854956.svg) center/contain no-repeat;"></div>
						<input class="input" id="Dir" type="text" placeholder="Direccion" required />
					</div>
					<div class="field contraseña">
						<div class="icon" style="background: url(https://image.flaticon.com/icons/svg/130/130996.svg) center/contain no-repeat;"></div>
						<input class="input" id="Password" type="password" placeholder="Contraseña" required />
					</div>
					<button class="button" id="submit">Registrarse
						<div class="side-top-bottom"></div>
						<div class="side-left-right"></div>
					</button>
					<small><a href="login.php">Login</a></small>
				</form>
			</div>
		</div>
	<?php
		include('html-source/js_load.html');
	?>

<script src="JS/form-3d.js"></script>
<script>
jQuery(document).ready(function(){
	$("#registro").submit(function(){
		var Nombre = $('#Nombre').val();
		var Correo = $('#Correo').val();
		var Telefono = $('#Tel').val();
		var Direccion = $('#Dir').val();
		var Contrasena = $('#Password').val();
		
		var parametros = {
		'Nom': Nombre,
		'Correo': Correo,
		'Tel': Telefono,
		'Dir': Direccion,
		'Password': Contrasena
		};
		$.ajax({
			data:parametros,
			url:"PHP/bdregistro.php",
			type:"post",
			beforeSend: function(){
				$("#loading").show();
			},
			success:function(datos){
				setTimeout(function(){
				$("#loading").hide();
				}, 1000);
				if(datos==1){
					swal("Error", "Usuario ya registrado.", "error");
				}else if(datos==2){
					swal("Exito","Correo de registro enviado","success");
				}else if(datos==3){
					swal("Error","Correo de registro no enviado","error");
				}else if(datos==4){
					swal("Error","No se ejecuto la consulta","warning");
				}else if(datos==5){
					swal("Error","Algunos campos están vacios","warning");
				}else{
					swal("Error",datos,"warning");
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