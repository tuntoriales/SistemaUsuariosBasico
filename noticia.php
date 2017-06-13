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

<p>
  <?php 
if(isset($_GET['id'])) {
	
	$query = mysql_query("SELECT * FROM noticias WHERE id = '".$_GET['id']."'");
	
	while($row=mysql_fetch_array($query)) { 
	
	$visitas = mysql_query("UPDATE noticias SET visitas = visitas + 1 WHERE id = '".$_GET['id']."'");
	
	$usuarios = mysql_query("SELECT * FROM usuarios WHERE id = '".$row['reportero']."'");		
	$user = mysql_fetch_array($usuarios);
?>
  
  <?php echo $row['titulo']; ?>
  <br />
  <?php echo $row['noticia']; ?>
  <br />
  <?php echo $user['usuario']; ?>
  <br />
  <?php echo $row['fecha']; ?>
  <br />
  <br />
  <a href="megustas.php?n=si&id=<?php echo $_GET['id']; ?>">Me Gusta</a> (<?php echo $row['megusta']; ?>) /
  <a href="megustas.php?n=no&id=<?php echo $_GET['id']; ?>">No Me Gusta</a> (<?php echo $row['nomegusta']; ?>)
  <br />
  VISITAS = <?php echo $row['visitas']; ?>
  <br />
  <br />
  
  <?php
	}
	?>
</p>

COMENTARIOS
<br /><br />

<?php 

$coment = mysql_query("SELECT * FROM comentarios WHERE not_id = '".$_GET['id']."' ORDER BY id DESC");
while($com=mysql_fetch_array($coment)) {
	
	$usuar = mysql_query("SELECT * FROM usuarios WHERE id = '".$com['usuario']."'");
	$us = mysql_fetch_array($usuar);
?>
	
    Usuario: <a href="perfil.php?id=<?php echo $com['usuario']; ?>"><?php echo $us['usuario']; ?></a>
    <br />
    Comentario: <?php echo $com['comentario']; ?>
    <br /><br />

<?php	
}

?>


<br />
<br />

<br />
<br />
Si deseas comenta algo
<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="textfield"></label>
    Comentar </p>
  <p>
  <textarea name="comentario" cols="90" rows="4" id="textfield"></textarea>
  </p>
  <p>
    <input type="submit" name="guardar" id="button" value="Comentar" />
  </p>
</form>
<p>&nbsp;</p>




<?php

if(isset($_POST['guardar'])) {

$insert = mysql_query("INSERT INTO comentarios (comentario,not_id,usuario) values ('".$_POST['comentario']."','".$_GET['id']."','".$_SESSION['id']."')");

if($insert) { echo "El comentario ha sido agregado"; header ("Location: noticia.php?id=$_GET[id]"); }

}

?>

<p>
  <?php
	
}
	?>
</p>
</body>
</html>