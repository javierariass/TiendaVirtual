<?php

if(isset($finalizar))
{
    $monto = clear($monto_total);
    $id_cliente = clear($_SESSION['id_cliente']);
    $q = $servidor->query("INSERT INTO compra (id_cliente,fecha,monto,estado) VALUES ('$id_cliente',NOW(),'$monto',0)");

    $sc = $servidor->query("SELECT * FROM compra WHERE id_cliente = '$id_cliente' ORDER BY id DESC LIMIT 1");
    $rc = mysqli_fetch_array($sc);
    $ultima_compra = $rc['id'];
    $q2 = $servidor->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");
    while($r2 = mysqli_fetch_array($q2))
    {
        $sp = $servidor->query("SELECT * FROM productos WHERE id = '".$r2['id_producto']."'");
        $rp = mysqli_fetch_array($sp);
        $monto = $rp['price'];
        $servidor->query("INSERT INTO productos_compra (id_compra,id_producto,cantidad,monto) VALUES ('$ultima_compra','".$r2['id_producto']."','".$r2['cant']."','$monto')");
    }
    $servidor->query("DELETE FROM carro WHERE id_cliente ='$id_cliente'");
    alert("Se ha finalizado la compra");
}
?>

<h1><i class="fa fa-shopping-cart"></i>Carro de Compras</h1>

<table class="table table-striped">
    <tr>
        <th><i class="fa fa-image"/></th>
        <th>Nombre del Producto</th>
        <th>Cantidad</yh>
        <th>Precio por Unidad</th>
        <th>Precio Total</th>
     </tr>
<?php

if(isset($_SESSION['id_cliente']))
{
    $id_cliente = clear($_SESSION['id_cliente']);
$q = $servidor->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");
$monto_total = 0;
while($r = mysqli_fetch_array($q))
{
    $q2 = $servidor->query("SELECT * FROM productos WHERE id = '".$r['id_producto']."'");
    $r2 = mysqli_fetch_array($q2);
    $nombre_producto = $r2['name'];
    $cantidad = $r['cant'];
    $precio_unidad = $r2['price'];
    $precio_total = $cantidad * $precio_unidad;
    $imagen_producto = $r2['imagen'];

    $monto_total = $monto_total + $precio_total;
    ?>
    <tr>
        <td><img src ="productos/<?=$imagen_producto?>" class="imagenes_carro"/></td>
        <td><?=$nombre_producto?></td>
        <td><?=$cantidad?></td>
        <td><?=$precio_unidad?> <?=$divisa?></td>
        <td><?=$precio_total?> <?=$divisa?></td>
    </tr>
     <?php
}
}

else
{
    $monto_total = 0;
}
?>
</table>
<h2>Monto Total: <b class="text-green"><?=$monto_total?> <?=$divisa?></h2>
<br></br>
<form method="post" action="">
    <input type="hidden" name="monto_total" value="<?=$monto_total?>"/>
<button class ="btn btn-primary" type="submit" name="finalizar"><i class="fa fa-check"></i> Finalizar Compra
</form>