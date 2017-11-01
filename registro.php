<?php
session_start();
include "includes/config.php";
include "includes/funciones.php";

ini_set('error_reporting',0);
?>

<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="textfield3"></label>
    Usuario: 
    <input type="text" name="usuario" maxlength="15" />
  </p>
  <p>
    Contraseña: 
    <input type="password" name="contrasena" />
  </p>
  <p>
    <input type="submit" name="guardar" value="Registrarse" />
  </p>
</form>

<?php
if ($_POST['guardar']) {
	
	$usuario = clean($_POST['usuario']);
	$contrasena = md5($_POST['contrasena']);
	
	$c = mysql_num_rows(mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario'"));
	if ($c == 1) { echo "El nombre de usuario esta en uso, por favor escoge otro gracias"; }
	else {
		$r = mysql_query("INSERT INTO usuarios (usuario,contrasena,rango) values ('$usuario','$contrasena','2')");
		if ($r) { echo "Felicidades, $usuario te haz registrado con éxito"; echo '<meta http-equiv="refresh" content="1;url=index.php" />'; }
	
}
}
?>