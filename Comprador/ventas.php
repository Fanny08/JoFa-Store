<?php
session_start();
if($_SESSION["inicio"]==true){
}else{
	header("location:productos.php");
}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>JoFa Store</title>
		<?php
			include('../html-source/comprador/head.html');
		?>
	</head>
<Body>

	<?php
		include('../html-source/comprador/menu.php');
	?>	
	<div class="container">
		<div class="col-md-12 mt-5"></div>
		<div class="row mt-5">
			<div class="col-md-12">
				<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-12 shadow-lg p-3 mb-3 trasparente rounded">
				<div class="col-md-12 text-center mb-4 encabezado">Detalles de la compra</div>
				<div class="row">	
				<div class="col-md-6 text-center mb-4">
					<div class="col-md-12 text-center mb-4 letra">
						Productos:
					</div>
					<div class="letrascompra" id="compra">
					</div>
				</div>
				<div class="col-md-6 text-center mb-4">
					<div class="col-md-12 text-center mb-4 letra">
						Datos del usuario:
					</div>
					<p class="letrascompra">Usuario: <?php echo $_SESSION["Nombre"];?></p>
					<p class="letrascompra">Correo: <?php echo $_SESSION["Correo"];?></p>
					<p class="letrascompra">Telefono: <?php echo $_SESSION["Telefono"];?></p>
					<p class="letrascompra">Dirección: <?php echo $_SESSION["Direccion"];?></p>
				</div>
				<div class="col-md-12 text-center mb-4 letra" id="compra_total"></div>
				<div class="col-md-4"></div>
				<div class="col-md-4"><button type="submit" class="btn btn-outline-primary col-md-12 letra">Comprar</button></div>
				<div class="col-md-4"></div>
				</div>
				</div>
				<div class="row mb-2"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
<script>
jQuery(document).ready(function(){
	$.ajax
	({
		url:"../PHP/getSesion.php",
		type:"post",
		success:function(datos)
		{
			if(datos==0){
				$("#menu-cerrarsesion").remove();
			}else
			{
				$("#menu-reg").remove();
				$("#menu-ing").remove();
			}
		}
	});
	
		$.ajax
	({
		url:"../PHP/productos/getFavoritos.php",
		type:"post",
		dataType: 'json',
		success:function(datos)
		{
			var total=0;
			for(var i=0; i<datos.productos.length; i++)
			{
				$('#compra').append(
					'<p>'+datos.productos[i].nombre+' $'+datos.productos[i].precio+'</p>'
				);
				total+=parseInt(datos.productos[i].precio);
			}
			$('#compra_total').html('$'+total);
		}
		
	});
});
</script>
</Body>
</html>