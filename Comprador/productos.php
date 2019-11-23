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
				<div class="col-md-12 text-center mb-4 encabezado">PRODUCTOS</div>
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
		url:"../PHP/productos/getProductos.php",
		type:"post",
		dataType: 'json',
		success:function(datos)
		{
			for(var i=0; i<datos.productos.length; i++)
			{
				$('#product').append(
					'<div class="col-md-4 text-center mb-4">'+
						'<div class="card" style="width: 18rem;">'+
							'<img src="'+datos.productos[i].imagen+'" class="card-img-top" alt="'+datos.productos[i].nombre+'">'+
							'<div class="card-body">'+
								'<h5 class="card-title">'+datos.productos[i].nombre+'</h5>'+
								'<h6 class="card-subtitle mb-2 text-muted">'+datos.productos[i].categorias+'</h6>'+
								'<p class="card-text">'+datos.productos[i].descripcion+'</p>'+
								'<a href="#" class="card-link">Ver Comentarios</a>'+
								'<a href="#" class="card-link">Comprar</a>'+
							'</div>'+
						'</div>'+
					'</div>'
				);
			}
		}
		
	});
});
</script>
</Body>
</html>