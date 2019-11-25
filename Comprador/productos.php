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
		include('../html-source/comprador/preloader.html');
	?>
	
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
	
	<?php
		include('../html-source/modal.html');
	?>	

	<?php
		include('../html-source/js_load.html');
	?>

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
				$("#form-comentario").empty();
				$("#form-comentario").html('Inicia sesión para poder comentar');
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
		beforeSend: function(){
			setTimeout(function(){
				$("#loading").show();
			}, 1000);
		},
		success:function(datos)
		{
			setTimeout(function(){
			$("#loading").hide();
			}, 2000);
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
								'<a href="#" class="card-link comentarios" data-id="'+datos.productos[i].id+'">Comentarios</a>'+
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
					beforeSend: function(){
						$("#loading").show();
					},					
					success:function(datos)
					{
					setTimeout(function(){
					$("#loading").hide();
					}, 1000);			
						if(datos==0){
							swal("Error", "No se encontro el producto.", "error");
						}else if(datos==1){
							swal("Exito","Agregado al carrito.","success");
						}else if(datos==2){
							swal("","Registrate o inicia sesión para continuar.", "warning");
						}else{
							swal("Error",datos,"warning");
						}
					}
				});
				return false;
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
					beforeSend: function(){
						$("#loading").show();
					},					
					success:function(datos)
					{
						setTimeout(function(){
						$("#loading").hide();
						}, 1000);
						if(datos==0){
							swal("Error", "No se encontro el producto.", "error");
						}else if(datos==1){
							location.href = "ventas.php";
						}else if(datos==2){
							swal("","Registrate o inicia sesión para continuar.", "warning");
						}else{
							swal("Error",datos,"warning");
						}
					}
				});
				return false;
			});
			

			
			$(".card-link.comentarios").click(function(){
				var id = $(this).data("id");
				loadComentarios(id);
				$('#modalComentarios').modal('show');
				return false;
			});
		}
		
	});
	
	function loadComentarios(id)
	{
		$('#modal-contenido').html('');
		
		$('#input-comentario').val('');
		
		$('#id-producto').val(id);
				
		var Parametros = {
			'id':id
		};
		$.ajax
		({
			data:Parametros,
			url:"../PHP/productos/getComentarios.php",
			type:"post",
			dataType: 'json',
			beforeSend: function(){
				$("#loading").show();
			},
			success:function(datos)
			{
				setTimeout(function(){
				$("#loading").hide();
				}, 1000);
				if(datos.comentarios)
				{
					$('#modal-titulo').html('Comentarios');
					for(var i=0; i<datos.comentarios.length; i++)
					{
						$('#modal-contenido').append
						(
							datos.comentarios[i].usuario +
							' : '+ datos.comentarios[i].comentario + '<br>'
						);
					}
				}
				else {
					$('#modal-titulo').html('Sin comentarios');
				}
			}
		});
		return false;
	}
	
	$("#form-comentario").submit(function ()
	{
		var id = $('#id-producto').val();
		var comentario = $('#input-comentario').val();
		
		var Parametros = {
			'id': id,
			'comentario': comentario
		};
		$.ajax
		({
			data:Parametros,
			url:"../PHP/productos/setComentario.php",
			type:"post",
			beforeSend: function(){
				$("#loading").show();
			},
			success:function(datos)
			{
				setTimeout(function(){
					$("#loading").hide();
				}, 1000);
				if(datos==1)
				{
					loadComentarios(id);
					swal("Exito","Comentario guardado","success");
				}else{
					swal("Error","Ocurrio un error al tratar de guardar el comentario","error");
				}
			}
		});
		return false;
	});
});
</script>
</Body>
</html>