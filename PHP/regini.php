<!DOCTYPE html>
<html lang="es">

	<head>
		<title>JoFa Store</title>
			<?php
			include('../html-source/user/head.html');
			?>
	</head>
	
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-light fixed-top">
			<a class="navbar-brand" href="#">
				<img src="../Imagenes/logo.png" width="250 px" height="50 px">
			</a>
			<div class="collapse navbar-collapse" id="navbarMenu">
			<ul class="nav">
				<li class="nav-item letmenu">
				  <a class="nav-link active" href="../index.php">Inicio</a>
				</li>
				
				<li class="nav-item dropdown letmenu">
					<a class="nav-link active" href="productos.php">Productos</a>
				</li>
				
				<li class="nav-item dropdown">
					<a href="ventas.php"><img src="../Imagenes/cart.png" width="45 px" height="45 px"></a>
				</li>
			</ul>
		</nav>
		<div class="container">
			<div class="col-md-12 mt-5"></div>
			<div class="row mt-5">
				<div class="col-md-5 shadow-lg p-4 mb-4 bg-white rounded trasparente">
					<form action="#" class="col-md-12" method="post" id="validar">						
						<div class="row">
							<div class="col-md-12 text-center rounded-circle mb-2"><img src="../Imagenes/add.png"></div>
							<div class="col-md-12 text-center mb-4 encabezado">Crea tu cuenta</div>				
							<div class="col-md-3 shadow-sm p-3 mb-3 letra">Nombre Completo:</div>
							<div class="col-md-9 shadow-sm p-3 mb-3"><input type="text" class="form-control" id="Nom" name="Nom" placeholder="Inserte su nombre." required></div>
							<div class="col-md-3 shadow-sm p-3 mb-3 letra">Correo Electronico:</div>
							<div class="col-md-9 shadow-sm p-3 mb-3 "><input type="email" class="form-control" id="Email" name="Email" placeholder="Inserte su email." required></div>
							<div class="col-md-3 shadow-sm p-3 mb-3 letra">Telefono:</div>
							<div class="col-md-9 shadow-sm p-3 mb-3 "><input type="text" class="form-control" onkeyup="onlyNumber(this)" id="Tel" name="Tel" placeholder="Inserte su telefono." required></div>
							<div class="col-md-3 shadow-sm p-3 mb-3 letra">Dirección:</div>
							<div class="col-md-9 shadow-sm p-3 mb-3 "><input type="text" class="form-control" id="Dir" name="Dir" placeholder="Inserte su dirección." required></div>
							<div class="col-md-3 shadow-sm p-3 mb-3 letra">Contraseña:</div>
							<div class="col-md-9 shadow-sm p-3 mb-3 "><input type="text" class="form-control" id="Contra" name="Contra" placeholder="Inserte una contraseña." required></div>
							<div class="col-md-8"></div>
							<div class="col-md-4"><button type="submit" class="btn btn-primary col-md-12 letra">Registrate</button></div>
						</div>	
					</form>	
				</div>
						<div class="col-md-2"></div>
					<div class="col-md-5 shadow-lg p-4 mb-4 bg-white rounded trasparente">
						<form action="#" class="col-md-12" method="post" id="valida">
							<div class="row">
								<div class="col-md-12 text-center rounded-circle mb-2"><img src="../Imagenes/user.png"></div>
								<div class="col-md-12 text-center mb-3 encabezado">BIENVENIDO</div>
								<div class="col-md-2"></div>
								<div class="col-md-8">
									<div class="row mb-4 shadow p-3 mb-3">
										<div class="col-md-2 "><i class="fas fa-user fa-2x text-dark"></i></div>
										<div class="col-md-10"> <input type="Email" class="form-control col-md-12" id="Usuario" name="Usuario" placeholder="Usuario" required></div>
									</div>
									<div class="row mb-4 shadow p-3 mb-3 ">
										<div class="col-md-2 "><i class="fas fa-key fa-2x text-dark"></i></div>
										<div class="col-md-10"><input type="password" class="form-control" id="password" name="password" placeholder="**********" required></div>
									</div>
									<div class="col-md-12 "><button type="submit" class="btn btn-primary col-md-12">Iniciar Sesión</button></div>
								</div>
								<div class="col-md-2 "></div>						
							</div>
						</form>						
					</div>
			</div>
		</div>
<script>
jQuery(document).ready(function(){
	$("#valida").submit(function () {
		var Correo = $('#Usuario').val();
		var Contra = $('#password').val();
		var Parametros = {
			'Usuario':Correo,
			'password':Contra
		};
		$.ajax({
			data:Parametros,
			url:"Validacion.php",
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
					location.href = "../index.php";						
				}else{
					swal("Error al inciar sesión: ", datos, "warning");
				}
			}
		});
		return false;
	});
});

	$("#validar").submit(function(){
		var Nom = $('#Nom').val();
		var Email = $('#Email').val();
		var Curp = $('#Curp').val();
		
		var parametros = {
		'Nom': Nom,
		'Email': Email,
		'Curp': Curp
		};
		$.ajax({
			data:parametros,
			url:"PHP/Registro.php",
			type:"post",
			beforeSend: function(){
				$("#loading").show();
			},
			success:function(datos){
			setTimeout(function(){	
			$("#loading").hide();
			}, 1000);
				if(datos==1){
					swal("Error", "Usuario o Curp ya registrados.", "error");
				}else if(datos==2){
					swal("Error", "Se ha superado el numero de registros.", "warning");
				}else if(datos==3){
					swal("Exito","Correo de registro enviado","success");
				}else if(datos==4){
					swal("Error","Correo de registro no enviado","error");
				}else if(datos==5){
					swal("Error","No se ejecuto la consulta","warning");
				}else if(datos==6){
					swal("Error","Algunos campos están vacios","warning");
				}else if(datos==7){
					swal("Error","El curp no pudo ser validado, verifica que sea el correcto.","warning");
				}else{
					swal("Error",datos,"warning");
				}
			}
		});

		return false;
	});
</script>

</body>
</html>