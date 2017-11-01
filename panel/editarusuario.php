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
<script language="JavaScript" type="text/javascript"> 
	<!-- 
	function Confirmar(frm) { 
	
	var borrar = confirm("¿Seguro que desea eliminar este usuario?"); 
	
	return borrar; //true o false 
	
	} 
	//--> 
</script> 
</head>

<body>

<?php include "barra_navegador.php"; ?>


<?php
if(isset($_GET['borrar'])) {
	
	$user = mysql_query("SELECT * FROM usuarios WHERE id = '".$_GET['borrar']."'");
	$us=mysql_fetch_array($user);
	
	$avatar = unlink("../".$us['avatar']."");
	
	$sql = mysql_query("DELETE FROM usuarios WHERE id = '".$_GET['borrar']."'");
	
}
?>


<table width="200" border="1">
  
  <thead>
      <tr>
        <td>ID</td>
        <td>Usuario</td>
        <td>Avatar</td>
        <td>Rango</td>
        <td>Opciones</td>
      </tr>
  </thead>

	<tbody>
<?php

	$query = mysql_query("SELECT * FROM usuarios");
	
	while($row=mysql_fetch_array($query)) { 
	
	$rango = mysql_query("SELECT * FROM rango WHERE id = '".$row['rango']."'");
	$ran = mysql_fetch_array($rango);
	
	?>

  <tr>
    <td width="4"><?php echo $row['id']; ?></td>
    <td width="4"><?php echo $row['usuario']; ?></td>
    <td width="100"><img src="../<?php echo $row['avatar']; ?>" width="100" height="100" /></td>
    <td width="4"><?php echo $ran['nombre']; ?></td>
    <td width="90"><a href="editarperfil.php?id=<?php echo $row['id']; ?>">Editar</a> | <a href="editarusuario.php?borrar=<?php echo $row['id']; ?>" onclick="return Confirmar (this.form)">Borrar</a></td>
  </tr>

  <?php		
	
	}

?>
	</tbody>
</table>

</body>
</html>

<?php } ?>