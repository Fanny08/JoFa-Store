<?php
include('../Conexion.php');
include('../Funciones.php');

$consultaSQL = $conexion -> query("
	SELECT
		idProductos,
		Nombre,
		Precio,
		Descripcion,
		Stock,
		Imagen
			FROM
				Productos
");

if($consultaSQL){
	
	$obj = new stdClass();

	while($raw = $consultaSQL -> fetch_assoc())
	{
		$idProducto = $raw['idProductos'];
		$categorias = [];
		
		$categoriasSQL = $conexion -> prepare("
			SELECT
				C.Nombre
					FROM
						Categoria C,
						PCategorias PC
							WHERE
								C.idCategoria = PC.Categoria_idCategoria AND
								PC.Productos_idProductos = ?");
		$categoriasSQL -> bind_param("i", $idProducto);
		$categoriasSQL -> execute();
		$result = $categoriasSQL -> get_result();
		while ($rew = $result -> fetch_assoc()) {
			array_push($categorias, $rew['Nombre']);
		}
		
		$obj -> productos[] =
		[
			"id" => $idProducto,
			"nombre" => $raw['Nombre'],
			"precio" => $raw['Precio'],
			"descripcion" => $raw['Descripcion'],
			"stock" => $raw['Stock'],
			"imagen" => $raw['Imagen'],
			"categorias" => $categorias
		];		
	}
	
	echo json_encode($obj);			
}
?>