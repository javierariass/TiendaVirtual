<?php
check_admin();

if(isset($enviar))
{
    $categoria = clear($categoria);
    $s = $servidor->query("SELECT * FROM categorias WHERE categoria = '$categoria'");
    if(mysqli_num_rows($s)>0)
    {
        alert("Ya esta categoria existe");
        ?>
               <script type="text/javascript">
                    window.location.replace("?p=agregar_categoria");
               </script>
               <?php
    }
    else
    {
        $servidor->query("INSERT INTO categorias (categoria) VALUES ('$categoria')");
        alert("Categoria Agregada");
    }
}

if(isset($eliminar))
{
    $servidor->query("DELETE FROM categorias WHERE id='$eliminar'");
    alert("Categoria Eliminada");
    ?>
               <script type="text/javascript">
                    window.location.replace("?p=agregar_categoria");
               </script>
               <?php

}

?>


<h1>Agregar Categoria</h1>
<form method="post" action="">
    <div class="form-group">
        <input type="text" class="form-control" name="categoria" placeholder="Categoria"/>
</div>

<p></p>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="enviar" value="Agregar Categoria"/>
</div>
</form>
<p></p>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Categoria</th>
        <th>Acciones</th>
</tr>

<?php
$q = $servidor->query("SELECT * FROM categorias ORDER BY categoria ASC");
while($r=mysqli_fetch_array($q))
{
    ?>
    <tr>
        <td><?=$r['id']?></td>
        <td><?=$r['categoria']?></td>
        <td> <a href="?p=agregar_categoria&eliminar=<?=$r['id']?>"><i class="fa fa-times"></i></a></td>
</tr>
<?php
}
?>