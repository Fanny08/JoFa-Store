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
					<div class="col-md-4"><button type="submit" class="btn btn-primary col-md-12 letra" id="btn-compra">Comprar</button></div>
					<div class="col-md-4"></div>
				</div>
				</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
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
			var total=0;
			for(var i=0; i<datos.productos.length; i++)
			{
				$('#compra').append(
					'<p>'+datos.productos[i].nombre+' $'+datos.productos[i].precio+'</p>'
				);
				total+=parseInt(datos.productos[i].precio);
			}
			$('#compra_total').html('$'+total);
			
			$("#btn-compra").click(function()
			{
				$.ajax
				({
					url:"../PHP/productos/getCompra.php",
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
						var PFaltantes = 0;
						var PVendidos = 0;
						$('#compra').html('');
						if(datos.faltantes)
						{
							PFaltantes = datos.faltantes.length;
							swal("","Algunos productos tienen faltantes.", "warning");
							for(var i=0; i<PFaltantes; i++)
							{
								$('#compra').append(
									'<p style = "color: red;">'+datos.faltantes[i].nombre+'</p>'
								);
							}
						}
						if(datos.vendidos)
						{
							PVendidos = datos.vendidos.length;
							for(var i=0; i<PVendidos; i++)
							{
								$('#compra').append(
									'<p style = "color: green;">'+datos.vendidos[i].nombre+'</p>'
								);
							}							
						}
						if(PVendidos>0){
							if(datos.status[0].code==3){
							swal("","Tu compra fue realizada, los detalles de la compra se enviaron a tu correo.", "success");
							}
							else{
								swal("","Realiza tu pago en oxxo a este numero de cuenta 5514 8520 1690 2605 lo más pronto posible.", "warning");
							}
						}if(PFaltantes>0){
							if(datos.status[0].code==3){
							swal("","Algunos productos tienen faltantes, los detalles de la compra se enviaron a tu correo..", "warning");
							}
							else{
								swal("","Algunos productos tienen faltantes, Realiza tu pago en oxxo a este numero de cuenta 5514 8520 1690 2605 lo más pronto posible.", "warning");
							}
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