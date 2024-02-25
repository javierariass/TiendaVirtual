<?php
check_admin();

$id = clear($id);

$q = $servidor->query("SELECT * FROM productos WHERE id='$id'");
$rq = mysqli_fetch_array($q);

if(isset($enviar))
{
    $idprod = clear($idprod);
    $name = clear($name);
	$price = clear($price);
    $categoria = clear($categoria);

    $servidor->query("UPDATE productos SET name ='$name', price='$price',id_categoria='$categoria' WHERE id = '$idprod'");
    ?>
               <script type="text/javascript">
                    window.location.replace("?p=agregar_producto");
               </script>
               <?php
}
?>

<form method ="post" action = "" enctype="multipart/form-data">
	<div class = "form-group">
		<input style="font-size: 20px" type="text" name="name" class="form-control" value="<?=$rq['name']?>" placeholder="Nombre del producto"/>
	</div>

	<p></p>

	<div class = "form-group">
		<input style="font-size: 20px" type="text" name="price" class="form-control" value="<?=$rq['price']?>" placeholder="Precio del producto"/>
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
				<option <?php if($rq['id_categoria'] == $r['categoria']){echo "selected";}?> value="<?=$r['id']?>"><?=$r['categoria']?></option>
				<?php
			}
			?>
        </select>
    </div>
	<p></p>
    <div class="form-group">
    	<button type="submit" class="btn btn-success" name = "enviar"><i class="fa fa-check"></i>Agregar Producto</button>
    </div>

    <input type="hidden" name="idprod" value="<?=$id?>"/>
</form>