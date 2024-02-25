<?php
if(isset($_SESSION['id_cliente']))
{
    redir("./");
}

if(isset($enviar))
{
	$username = clear($username);
	$password = clear($password);

	$q = $servidor->query("SELECT * FROM clientes WHERE username = '$username' AND password = '$password'");
  
	if(mysqli_num_rows($q)  >0){
		$r = mysqli_fetch_array($q);
		$_SESSION['id_cliente'] = $r['id'];
		redir("./");		
	}

	else
	{
		alert("Los datos no son validos");
		redir("?p=login");
	}
}
?>
<center>
	<form method="post" action="">

	<label style="font-size: 40px"><h2><i class="fa fa-key"></i>Iniciar Seccion</h2></label>
	
	
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
