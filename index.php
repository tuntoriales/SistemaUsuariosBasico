<?php
session_start();
include "includes/config.php";
include "includes/funciones.php";

if(!isset($_SESSION['usuario'])) {
	header("Location: login.php");
}

ini_set('error_reporting',0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<?php include "barra_navegador.php"; ?>

<?php

	$query = mysql_query("SELECT * FROM usuarios WHERE id = '".$_SESSION['id']."'");
	$row = mysql_fetch_array($query);
	$rango = mysql_query("SELECT * FROM rango WHERE id = '".$row['rango']."'");
	$ran = mysql_fetch_array($rango);

?>

Bienvenido <p style="color:<?php echo $ran['color']; ?>"><?php echo $_SESSION['usuario']; ?> (<?php echo $_SESSION['rango']; ?>)</p>

<br />

<?php

	$noticia = mysql_query("SELECT * FROM noticias ORDER BY id DESC");
	while($not=mysql_fetch_array($noticia))
	{
	
	$usuarios = mysql_query("SELECT * FROM usuarios WHERE id = '".$not['reportero']."'");		
	$user = mysql_fetch_array($usuarios);
	
	$cont = mysql_query("SELECT * FROM comentarios WHERE not_id = '".$not['id']."'");
	$contar = mysql_num_rows($cont);

		?>
	
    
    <a href="noticia.php?id=<?php echo $not['id']; ?>"><?php echo $not['titulo']; ?></a>
    <br />
    <?php echo $not['noticia']; ?>
    <br />
    <?php echo $user['usuario']; ?>
    <br />
    <?php echo $not['fecha']; ?>
    <br />
    Comentarios (<?php echo $contar; ?>)
    <br />
    <br />
    
		
		<?php
	}

?>


</body>
</html>