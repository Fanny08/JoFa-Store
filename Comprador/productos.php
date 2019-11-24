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
	
	
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-titulo">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-contenido">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
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
							'<div class="card-header">'+datos.productos[i].nombre+'</div>'+
							'<img src="../Imagenes/productos/'+datos.productos[i].imagen+'" class="card-img-top align-self-center" style="width: 150px; height: 150px;" alt="'+datos.productos[i].nombre+'">'+
							'<div class="card-body">'+
								'<h5 class="card-title">$'+datos.productos[i].precio+'</h5>'+
								'<h6 class="card-subtitle mb-2 text-muted">'+datos.productos[i].categorias+'</h6>'+
								'<p class="card-text">'+datos.productos[i].descripcion+'</p>'+
								
								'<a href="#" class="card-link carrito" data-id="'+datos.productos[i].id+'">Carrito</a>'+
								'<a href="#" class="card-link compra" data-id="'+datos.productos[i].id+'">Comprar</a>'+
								'<p>'+
								'<a href="#" class="card-link">Comentarios</a>'+
								'</p>'+
							'</div>'+
						'</div>'+
					'</div>'
				);
			}
			$(".card-link.carrito").click(function(){
				var id = $(this).data("id");
				var Parametros = {
					'id':id
				};
				$.ajax
				({
					data:Parametros,
					url:"../PHP/productos/Agegarcarrito.php",
					type:"post",
					success:function(datos)
					{
						if(datos==0){
							swal("Error", "No se encontro el producto.", "error");
						}else if(datos==1){
							swal("Exito","Agregado al carrito.","success");
						}else if(datos==2){
							swal("Registrate o inicia sesión para continuar.", "warning");
						}else{
							swal("Error",datos,"warning");
						}
					}
				});
			});
			$(".card-link.compra").click(function(){
				var id = $(this).data("id");
				var Parametros = {
					'id':id
				};
				$.ajax
				({
					data:Parametros,
					url:"../PHP/productos/Agegarcarrito.php",
					type:"post",
					success:function(datos)
					{
						if(datos==0){
							swal("Error", "No se encontro el producto.", "error");
						}else if(datos==1){
							location.href = "ventas.php";
						}else if(datos==2){
							swal("Registrate o inicia sesión para continuar.", "warning");
						}else{
							swal("Error",datos,"warning");
						}
					}
				});
			});
		}
		
	});
});
</script>
</Body>
</html>