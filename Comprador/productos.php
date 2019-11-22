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
			if(datos.Total != 0)
			{
				totPreguntas = datos.Total;
				for(var i=0; i<datos.Total; i++)
				{
					$('#product').append(
						'<div class="col-md-4 text-center mb-4">'+
							'<div class="card" style="width: 18rem;">'+
								'<img src="..." class="card-img-top" alt="...">'+
								'<div class="card-body">'+
									'<h5 class="card-title">Card title</h5>'+
									'<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>'+
									'<p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>'+
									'<a href="#" class="card-link">Card link</a>'+
									'<a href="#" class="card-link">Another link</a>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="col-md-4 text-center mb-4">'+
							'<div class="card" style="width: 18rem;">'+
								'<img src="..." class="card-img-top" alt="...">'+
								'<div class="card-body">'+
									'<h5 class="card-title">Card title</h5>'+
									'<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>'+
									'<p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>'+
									'<a href="#" class="card-link">Card link</a>'+
									'<a href="#" class="card-link">Another link</a>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="col-md-4 text-center mb-4">'+
							'<div class="card" style="width: 18rem;">'+
								'<img src="..." class="card-img-top" alt="...">'+
								'<div class="card-body">'+
									'<h5 class="card-title">Card title</h5>'+
									'<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>'+
									'<p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>'+
									'<a href="#" class="card-link">Card link</a>'+
									'<a href="#" class="card-link">Another link</a>'+
								'</div>'+
							'</div>'+
						'</div>'
					);
				}
			}
					
		}
		
	});
});
</script>
</Body>
</html>