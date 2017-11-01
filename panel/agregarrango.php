<?php
session_start();
include "../includes/config.php";
include "../includes/funciones.php";

if(!isset($_SESSION['usuario'])) {
	header("Location: ../login.php");
}

if($_SESSION['rango'] == '1' or $_SESSION['rango'] == '3') {

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

<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="textfield"></label>
    Nombre del rango: 
    <input type="text" name="nombre" id="textfield" />
  </p>
  <p>Color del rango: 
    <input type="text" name="color" id="textfield2" />
  </p>
  <p>
    <input type="submit" name="guardar" id="button" value="Agregar Rango" />
  </p>
</form>

<?php
	if(isset($_POST['guardar'])) {
		
			$query = mysql_query("INSERT INTO rango (nombre,color) values ('".$_POST['nombre']."','".$_POST['color']."')");
			
			if($query) { echo "El rango ha sido insertado correctamente"; }
		
	}
?>
</body>
</html>

<?php } ?>