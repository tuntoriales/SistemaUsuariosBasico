<style type="text/css">
#navegador ul{
   list-style-type: none;
}
#navegador li{
   display: inline;
   text-align: center;
   margin: 0 10px 0 0;
}
</style>

<div id="navegador">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <?php if($_SESSION['rango'] == '1') { ?><li><a href="editarusuario.php">Editar Usuarios</a><?php } ?></li>
        <?php if($_SESSION['rango'] == '1') { ?><li><a href="rangos.php">Editar Rangos</a></li><?php } ?>
        <li><a href="agregarnoticia.php">Agregar Noticia</a></li>
        <li><a href="../logout.php">Salir</a></li>
    </ul>
</div>
