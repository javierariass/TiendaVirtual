<?php

$q = $servidor->query("SELECT * FROM productos ORDER BY id DESC");

while ($r = mysqli_fetch_array($q)) 
{
	?>
	<div class = "producto">
		<div class ="name_producto"> <?=$r['name']?></div>
		<div> <img class = "img_producto" src = "productos/<?=$r['imagen']?>"/> </div>
		<span class="precio"><?=$r['price']?></span>
		<button style="height: 20px; width: 20px;" class="btn btn-warning pull-right"><i class="fa fa-shopping-cart"></i></button>
	</div>
	<?php 
}
?>