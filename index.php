<?php
	include "configs/config.php";
	include "configs/funciones.php";

	if(!isset($p))
	{
		$p = "principal";
	}
	else
	{
		$p = $p;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" href = "css/estilos.css" />
	<link rel = "stylesheet" href = "bootstrap/css/bootstrap.css" />
	<link rel = "stylesheet" href = "fontawesome-free-6.5.0-web\css\all.min.css" />
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="fontawesome/js/all.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<title>Tienda Online</title>
</head>
<body>
	<div class = "header">
		Tienda Virtual
	</div>

	<div class = "menu">
		<a href = "?p=principal"> Principal </a>
		<a href = "?p=productos"> Productos </a>
		<a href = "?p=ofertas"> Ofertas </a>
		<a href = "?p=carrito" > Carrito </a>
		<a href = "?p=admin"> Administrador</a>

		<?php
		if(isset($_SESSION['id_cliente']))
		{
			?>
			<a class ="float-end" href = "?p=salir">Salir</a>
		    <a class ="float-end" href = "#"><?=nombre_cliente($_SESSION['id_cliente'])?></a>
			<?php
		}
		?>
		
	</div>

	<div class = "cuerpo">
		<?php
		if(file_exists("modulos/" .$p. ".php"))
		{
			include "modulos/" .$p. ".php";
		}

		else
		{
			echo "<i> No se ha encontrado el modulo <b>" .$p. "</b></i>";
		}
		?>
	</div>
</body>
</html>