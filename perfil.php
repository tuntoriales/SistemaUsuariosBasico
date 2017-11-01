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
if(isset($_GET['id'])) {
	
	$query = mysql_query("SELECT * FROM usuarios WHERE id = '".$_GET['id']."'");
	
	while($row=mysql_fetch_array($query)) { 
?>

<a href="index.php">Regresar al inicio</a>
<br /><br />
    
Bienvenido <strong><?php echo $_SESSION['usuario']; ?> </strong> 

<br />
<?php if($row['avatar'] != '') { ?>
<img src="<?php echo $row['avatar']; ?>" height="100" width="100" />
<?php } ?>
<br />
<?php if($_SESSION['id'] == $_GET['id']) {?>
<a href="editarperfil.php?id=<?php echo $_SESSION['id']; ?>">Editar mi perfil</a>
<?php } ?>
    	
		
<?php		
	}
	
}
?>

</body>
</html>