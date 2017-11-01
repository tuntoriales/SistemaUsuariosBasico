<?php
session_start();
include "includes/config.php";
include "includes/funciones.php";

if(!isset($_SESSION['usuario'])) {
	header("Location: login.php");
}

ini_set('error_reporting',0);

if($_SESSION['id'] != $_GET['id']) {
	header("Location: index.php");
}
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



<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p>
    <label for="textfield2"></label>
    Usuario: 
    <input type="text" name="usuario" id="textfield2" value="<?php echo $row['usuario']; ?>" />
  </p>
  <p>
    Contraseña: 
    <input type="text" name="contrasena" id="textfield" />
  </p>
  <p>Avatar</p>
  <p><img src="<?php echo $row['avatar']; ?>" height="100" width="100" />
    
  </p>
  <p>
    <label for="fileField"></label>
    <input type="file" name="avatar" id="fileField" />
  </p>
  <p>
    <input type="submit" name="editar" id="button" value="Editar Perfil" />
  </p>
</form>

<?php if(isset($_POST['editar'])) {
	
	$usuario = clean($_POST['usuario']);
	if($_POST['contrasena'] != '') { $contrasena = md5($_POST['contrasena']); } else { $contrasena = $row['contrasena']; }

	$tips = 'jpg';
	$type = array('image/jpeg' => 'jpg');
	$id = $row['id'];
				  
	$nombrefoto1=$_FILES['avatar']['name'];
	$ruta1=$_FILES['avatar']['tmp_name'];
	$name = $id.'.'.$tips;
	if(is_uploaded_file($ruta1))
	{ 
	$destino1 =  "perfiles/".$name;
	copy($ruta1,$destino1);
	}
	else
	{
		$destino1 = $row['avatar'];
	}

	$sql = mysql_query("UPDATE usuarios SET usuario = '".$usuario."', contrasena = '".$contrasena."', avatar = '".$destino1."' WHERE id = '".$_GET['id']."'");
	
	if($sql) { echo "Se han actualizado los datos"; }
	
}
?>


<?php
	}
}
?>

</body>
</html>