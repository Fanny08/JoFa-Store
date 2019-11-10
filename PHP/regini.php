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
				<img src="../Imagenes/logo.jpg" width="250 px" height="50 px">
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
										<div class="col-md-10"><input type="password" class="form-control" id="CurpL" name="CurpL" placeholder="**********" required></div>
									</div>
									<div class="col-md-12 "><button type="submit" class="btn btn-primary col-md-12">Iniciar Sesión</button></div>
								</div>
								<div class="col-md-2 "></div>						
							</div>
						</form>						
					</div>
			</div>
		</div>

</body>
</html>