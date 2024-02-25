<select id="categoria" onchange="redir_cat()" class="form-control">
<option value="">Selecione una Categoria para Filtrar</option>

<?php

$cats = $servidor->query("SELECT * FROM categorias ORDER BY categoria ASC");
while($rcat = mysqli_fetch_array($cats))
{
	?>
	<option value="<?=$rcat['id']?>"><?=$rcat['categoria']?></option>
	
	<?php
}
?>
</select>
<?php

check_user("productos");
if(isset($cat))
{
	$sc = $servidor->query("SELECT * FROM categorias WHERE id ='$cat'");
	$rc = mysqli_fetch_array($sc);
	?>
	<h1>Categoria Filtrada por: <?=$rc['categoria']?></h1>
	<?php
}
if(isset($agregar) && isset($cant))
{
	$idp = clear($agregar);
	$cant = clear($cant);
	$id_cliente = clear($_SESSION['id_cliente']);
	$v = $servidor->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	if(mysqli_num_rows($v)>0)
	{
		$q = $servidor->query("UPDATE carro SET cant = cant + $cant WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	}
	else
	{
		$q = $servidor->query("INSERT INTO carro (id_cliente,id_producto,cant) VALUES ($id_cliente,$idp,$cant)");
	}
	alert("Se ha agregado al carro de compras");
}
if(isset($cat))
{
	$q = $servidor->query("SELECT * FROM productos WHERE id_categoria ='$cat' ORDER BY id DESC");
}

else{
	$q = $servidor->query("SELECT * FROM productos ORDER BY id DESC");
}
while ($r = mysqli_fetch_array($q)) 
{
	?>
	<div class = "producto">
		<div class ="name_producto"> <?=$r['name']?></div>
		<div> <img class = "img_producto" src = "productos/<?=$r['imagen']?>"/> </div>
		<span class="precio"><br><?=$r['price']?> <?=$divisa?></span>
		<button class="btn btn-warning float-end" onclick = "agregar_carro('<?=$r['id']?>');"><i class="fa fa-shopping-cart"></i></button>
	</div>
	<?php 
}
?>

<script type="text/javascript">
	function agregar_carro(idp)
	{
		var cant = prompt("Que cantidad desea agregar",1);
		if(cant.length > 0)
		{
			window.location = "?p=productos&agregar="+ idp+"&cant="+cant;
		}
	}
	function redir_cat()
	{
		var cod = document.getElementById("categoria").value;
		window.location = "?p=productos&cat="+ cod;
	}
</script>