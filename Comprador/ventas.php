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
				<div class="col-md-12 text-center mb-4 encabezado">COMPRA</div>
				<div class="row" id="product">	
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
});
</script>
</Body>
</html>