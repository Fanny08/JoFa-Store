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
<script src="../JS/form-3d.js"></script>
</body>
</html>