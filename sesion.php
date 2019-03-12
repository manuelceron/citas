<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Citas para Asesoría</title> 
<link rel="stylesheet" href="estilo.css"> 
</head>
<body>
<?php require ("conex.php");

require ('function.php');
echo menu();
?><h1>Iniciar Sesi&oacute;n</h1><?php
if (isset($_POST['usu']) and isset($_POST['clave'])){ //validar
$u=$_POST['usu'];
$c=$_POST['clave'];
$sql="select cedula, usuario, nombre, apellido, tipo from cita_asesor where (cedula='$u' or usuario='$u') and clave='".sha1($c)."'";
$consulta = $mysqli->query($sql);
//Valida si la variable $consulta le devuelve filas al hacer la consulta en la BD, si fuese así muestra la tabla con los registros 
$consulta->num_rows;
if ($d=$consulta->fetch_assoc()){
//$r=mysqli_query($sql);
//if ($d=mysqli_fetch_assoc($r)){
$_SESSION['asesores_usu']=$d['usuario'];
$_SESSION['asesores_ide']=$d['cedula'];
$_SESSION['asesores_nom']=$d['nombre'];
$_SESSION['asesores_ape']=$d['apellido'];
$_SESSION['asesores_tipo']=$d['tipo'];
header('Location: index.php');
}
else{
?>
<p>Usuario no v&aacute;lido, por favor </p>
<p><a href="index.php?registro=nuevo">Registrarse</a> o <a href="index.php">Iniciar sesi&oacute;n</a></p>
<?php
}
}//finvalidar
//session_start();
if (!isset($_SESSION['asesores_usu']) and !isset($_GET['registro'])){//login
?>
 <div align="center">
 <div class="container">
	<section id="content">
<form id="form1" name="form1" method="post" action="sesion.php">
 <div><label>
    <p>Usuario
      <input type="text" name="usu"  id="username" required/>
    </p></label>
 </div>
 <div>
    <label>Clave  	
    <input type="password" name="clave" id="password" required/>
    </label>
  </div>
  <div>
    <a href="#">Olvid&oacute; su contrase&ntilde;a?</a>
    <p><a href="index.php?registro=nuevo" name="button" id="button">Registrarse</a></p>
    <p>
      <input type="submit" name="button" id="button" value="Iniciar" />
    </p>
      </div>
  <p>
    <label></label>
  </p>
</form>
</section>
</div>
<?php
}//finlogin
?>
<body>
</body>
</html>
<?php

if (isset($_GET['registro'])){ //registro
if ($_GET['registro'] == "nuevo"){
?>
 <div class="container">
	<section id="content">
<form id="form1" name="form1" method="post" action="sesion.php?registro">
  <label>
  <div align="center">
    <p>Usuario
      <input placeholder="Escriba el nombre de usuario" type="text" name="usu" id="username" />
    </p>
    <label>Clave  	
    <input placeholder="Escriba la clave" type="password" name="clave" id="password" />
    </label>
    <label><br />
    <br />
   Comfirmar
    <input placeholder="Vuelva a escribir la clave" type="password" name="clave2" id="password" />
    </label>
    <p>&nbsp</p>
    <p>
      <input type="submit" name="button" id="button" value="Enviar" />
      <a href="index.php">Regresar</a>
    </p>
  </div>
  <p>
    <label></label>
  </p>
</form>
</section>
</div>
<?php
}//if ($_GET['registro'] == "nuevo"){
	if (isset($_POST['usu'])){ //validarregistro
	?>
	<div align="center">
	<div class="container">
	<section id="content">
    <div><h1>Registro</h1></div>
    <?php
	$u=$_POST['usu'];
	$c1=$_POST['clave'];
	$c2=$_POST['clave2'];
		if ($c1<>$c2){
			echo "<div>Error las claves no coinciden, por favor intente de nuevo</div>";
			echo "<div><p><a href='sesion.php?registro=nuevo'>Continuar</a></p></div>";
		}else{
			$sql="select usuario,clave from login where usuario = '$u'";
				//$r=mysqli_query($sql);
				$consulta = $mysqli->query($sql);
				if ($consulta->num_rows){
				if ($consulta->fetch_assoc()){
				echo "<div>el usuario ".$u." ya esiste</div>";
				echo "<div><p><a href='sesion.php'>Continuar</a></p></div>";
				}
				}
				else{
				$sql2="insert into login values ('".$u."','".sha1($c1)."')";
				if ($consulta2 = $mysqli->query($sql2))
				echo "<div><p>el usuario ".$u." se creó correctamente</p><p><a href='sesion.php'>Iniciar sesión</a></p><div>";
				else
				echo "<div><p>el usuario ".$u." no se creó correctamente/<p><p><a href='sesion.php'>Iniciar sesión</a></p></div>";
				}//fin if $consulta
		}//if ($c1<>$c2){
	?></section>
</div></div><?php
	}//finvalidarregistro
}//fin ?registro
if (isset($_GET['logout'])){//logout
unset ($_SESSION['asesores_usu']);
unset ($_SESSION['asesores_nom']);
unset ($_SESSION['asesores_ape']);
session_destroy();
header('Location: index.php');
}//finlogout
if (isset($_SESSION['asesores_usu'])){//login
/*echo "	<div align='right'><p>Bienvenido ".$_SESSION['usu']."  ";
?>
<a href="index.php?logout">cerrar sesi&oacute;n</a></p> </div>
<?php */
}
?>
</body>
</html>