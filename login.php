<?php
session_start();
include "includes/config.php";
include "includes/funciones.php";

if(isset($_SESSION['usuario'])) {
	header("Location: index.php");
}

ini_set('error_reporting',0);
?>

<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="textfield"></label>
    Usuario: 
    <input type="text" name="usuario" id="textfield" />
  </p>
  <p>
    Contraseña: 
    <input type="password" name="contrasena" id="textfield2" />
  </p>
  <p>
    <input type="submit" name="guardar" id="button" value="Entrar" />
  </p>
</form>

<br />
<a href="registro.php">Regístrate</a>

<?php
if($_POST['guardar']) {

	$usuario = clean($_POST['usuario']);
	$contrasena = md5($_POST['contrasena']);
	
	$query = mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'");
	
	$contar = mysql_num_rows($query);
	
	if ($contar != 0) {
	
		while($row=mysql_fetch_array($query)) {
		
			if($usuario == $row['usuario'] && $contrasena == $row['contrasena']) 
			
			{
			
				$_SESSION['usuario'] = $usuario;
				
				$_SESSION['id'] = $row['id'];
				
				$_SESSION['rango'] = $row['rango'];
				
				header("Location: index.php");
				
			}
			
		} 
		
	} else { echo "El nombre de usuario y/o contrasena no coinciden"; }
	
}
?>