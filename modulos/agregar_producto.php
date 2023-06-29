<?php
check_admin();

if(isset($enviar))
{
	$name = clear($name);
	$price = clear($price);

	$imagen = "";

	if(is_uploaded_file($_FILES['imagen']['tmp_name']))
	{
		$imagen = $name.rand(0,1000).".png";
		move_uploaded_file($_FILES['imagen']['tmp_name'],"productos/".$imagen);
	}

	$servidor->query("INSERT INTO productos(name,price,imagen) VALUES ('$name','$price','$imagen')");
	alert("Producto Agregado");
	redir("?p=agregar_producto");
}
?>

<form method ="post" action = "" enctype="multipart/form-data">
	<center>
	<div class = "form-group">
		<input style="font-size: 20px" type="text" name="name" class="form-control" placeholder="Nombre del producto"/>
	</div>

	<p></p>

	<div class = "form-group">
		<input style="font-size: 20px" type="text" name="price" class="form-control" placeholder="Precio del producto"/>
	</div>

	<p></p>

	<label style="font-size: 30px">Imagen del producto</label>
	<p></p>
	<p></p>
	<p></p>

	<div class="form-group">
	<input style="font-size: 20px" type="file" class="form-control" name="imagen" title = "Imagen del producto" placeholder="Imagen del producto"/>
    </div>

    <p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>

    <div class="form-group">
    	<button style="font-size: 20px" type="submit" class="btn btn-success" name = "enviar"><i class="fa fa-check"></i>Agregar Producto</button>
    </div>
</center>
</form>