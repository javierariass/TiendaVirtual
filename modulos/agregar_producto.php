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

	$servidor->query("INSERT INTO productos(name,price,imagen,id_categoria) VALUES ('$name','$price','$imagen',$categoria)");
	alert("Producto Agregado");
	redir("?p=agregar_producto");
}

if(isset($eliminar))
{
	$servidor->query("DELETE FROM productos WHERE id='$eliminar'");
	?>
               <script type="text/javascript">
                    window.location.replace("?p=agregar_producto");
               </script>
               <?php
}
?>

<form method ="post" action = "" enctype="multipart/form-data">
	<div class = "form-group">
		<input style="font-size: 20px" type="text" name="name" class="form-control" placeholder="Nombre del producto"/>
	</div>

	<p></p>

	<div class = "form-group">
		<input style="font-size: 20px" type="text" name="price" class="form-control" placeholder="Precio del producto"/>
	</div>

	<label style="font-size: 30px">Imagen del producto</label>
	
	<div class="form-group">
	<input type="file" class="form-control" name="imagen" title = "Imagen del producto" placeholder="Imagen del producto"/>
    </div>

	<p></p>

	<div class="form-group">
		<select name="categoria" required class="form-control">
			<option value="">Selecione una categoria</option>
			<?php
			$q = $servidor->query("SELECT * FROM categorias ORDER BY categoria ASC");
			while($r=mysqli_fetch_array($q))
			{
				?>
				<option value="<?=$r['id']?>"><?=$r['categoria']?></option>
				<?php
			}
			?>
        </select>
    </div>
	<p></p>
    <div class="form-group">
    	<button style="font-size: 20px" type="submit" class="btn btn-success" name = "enviar"><i class="fa fa-check"></i>Agregar Producto</button>
    </div>
</form><br>
<br>
<table class="table table-striped">
<tr>
	<th>Nombre</th>
	<th>Precio</th>
	<th>Imagen</th>
	<th>Categoria</th>
	<th>Acciones</th>
<tr>

<?php
$prod = $servidor->query("SELECT * FROM productos ORDER BY id DESC");
while($rp = mysqli_fetch_array($prod))
{
	$cat = $servidor->query("SELECT * FROM categorias WHERE id ='".$rp['id_categoria']."'");
	if(mysqli_num_rows($cat) >0)
	{
		$rcat = mysqli_fetch_array($cat);
		$categoria = $rcat['categoria'];
	}

	else{
		$categoria="--";
	}
	
	?>
	<tr>
		<td><?=$rp['name']?></td>
		<td><?=$rp['price']?></td>
		<td><img src ="productos/<?=$rp['imagen']?>" class="imagenes_carro"/></td>
		<td><?=$categoria?></td>
		<td><a href="?p=modificar_producto&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
		&nbsp;
	    <a href="?p=agregar_producto&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a></td>		
	<?php
}
?>
		</table>