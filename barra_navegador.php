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
        <li><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>">Perfil</a></li>
        <?php if($_SESSION['rango'] == '1' or $_SESSION['rango'] == '3') { ?><li><a href="panel">Panel</a></li><?php } ?>
        <li><a href="logout.php">Salir</a></li>
    </ul>
</div>