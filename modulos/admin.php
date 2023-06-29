<?php

if(isset($enviar))
{
	$username = clear($username);
	$password = clear($password);

	$q = $servidor->query("Select *FROM admin WHERE user = '$username' AND pass = '$password'");
  
	if($q->num_rows  >0){
		$r = $q->fetch_array();
		$_SESSION['id'] = $r[0];
		redir("?p=admin");		
	}

	else
	{
		alert("Los datos no son validos");
		redir("?p=admin");
	}
}

if(isset($_SESSION['id']))
{
	?>
	<a href="?p=agregar_producto">
	<button class="btn btn-primary"><i class="fa fa-plus-circle"></i>Agregar Productos</button> 
</a>
<?php
}

else
{
	?>

<center>
	<form method="post" action="">

	<label style="font-size: 40px"><h2><i class="fa fa-key"></i>Iniciar Seccion Como Administrador</h2></label>
	
	
	<div class = "form-group">
		<input  style="font-size: 20px;padding: 10px;" size="40" type="text" class = "form-control" placeholder="Usuario" name="username"/>
	</div>

	<p></p>

	<div class = "form-group">
		<input style="font-size: 20px; padding: 10px;" size="40" type="password" class = "form-control" placeholder="Contraseña" name="password"/>
	</div>
<p></p>
	<div class = "form-group">
		<button style="font-size: 30px" class = "btn btn.submit" name = "enviar" type="submit"><i class="fa fa-sign-in"></i>Ingresar</button>
	</div>


</form>
</center>
	<?php
}
?>