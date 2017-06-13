<?php
session_start();
include "includes/config.php";
include "includes/funciones.php";

if(!isset($_SESSION['usuario'])) {
	header("Location: login.php");
}

ini_set('error_reporting',0);


?>
<?php

if(isset($_GET['n']))
{
	if($_GET['n'] == 'si') {
		$si = mysql_query("UPDATE noticias SET megusta = megusta + 1 WHERE id = '".$_GET['id']."'");
		header("Location: noticia.php?id=$_GET[id]");
	}
	if($_GET['n'] == 'no') {
		$si = mysql_query("UPDATE noticias SET nomegusta = nomegusta + 1 WHERE id = '".$_GET['id']."'");
		header("Location: noticia.php?id=$_GET[id]");
	}
	
}

?>