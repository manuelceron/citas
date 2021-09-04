	<?php require('conex.php'); 
session_start();
if(!isset($_SESSION['asesores_usu'])){
exit();
}
//require('funciones.php');
require('function.php');
$nombretabla = "cita_asesor";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--script language="javascript" type="text/javascript" src="js/tabla.js"></script><!--scroll--->
<!--link rel="stylesheet" type="text/css" href="css/tabla.css" /><!--tablas--->
<link rel="stylesheet" type="text/css" href="css/estilo.css" /><!--tablas--->
<link rel="stylesheet" href="estilo.css"> 
<title>Citas para Asesoría</title>
<style type="text/css">
.h {
	font-family: Comic Sans MS, cursive;
}
</style>
</head>

<body><?php menu(); 
if(isset($_SESSION['asesores_usu'])){
if ($_SESSION['asesores_tipo']=="admin" or $_SESSION['asesores_tipo']=="coordinador"){
}else{
	echo "No tiene los permisos para administrar asesores";
	exit();
}
}
?>
<p align="center">
<h1 class="titulos">Mi Proyecto</h1>
<p>
  <?php

if (isset($_POST['submit'])){
	switch ($_POST['submit']){
	case "Registrar":
	//recibo los campos del formulario proveniente con el método POST
	$cod = $_POST['cod'];
	$nom = $_POST['nom'];
	$ape = $_POST['ape'];
	$usu = $_POST['usu'];
	$cla = $_POST['cla'];
	//Instrucción SQL que permite insertar en la BD
	$sql = 'INSERT INTO cita_asesor(`cedula`, `nombre`, `apellido`, `clave`, `usuario`) 
	VALUES("'.$cod.'","'.$nom.'","'.$ape.'","'.sha1($cla).'","'.$usu.'")';
	//echo $sql;
	//Se conecta a la BD y luego ejecuta la instrucción SQL
	if ($insertar = $mysqli->query($sql)) {
	//Validamos si el registro fue ingresado con éxito
	echo 'Registro exitoso';
	echo '<meta http-equiv="refresh" content="1; url=asesor.php" />';
	}
	else {echo 'Registro fallido';}
	
	break;
	case "Nuevo":
	echo "Ingresando un ";
	echo $_POST['submit'];
	?>
<form id="form1" name="form1" method="post" action="asesor.php">
  <h1>Registrar</h1>
  <p>
    <label for="cod">Identificación:</label>
    <input name="cod" type="text" id="cod"  size="12" maxlength="12" required>
  </p>
  <p>
    <label for="nom">Nombre:</label>
    <input name="nom" type="text" id="nom" size="60" maxlength="60" required>
  </p>
  <p>
    <label for="ape">Apellido:</label>
    <input name="ape" type="text" id="ape" size="60" maxlength="60" required>
  </p>
   <p>
    <label for="usu">Usuario:</label>
    <input name="usu" type="text" id="cla" value="" size="60" required>
  </p>
    <p>
    <label for="cla">Clave:</label>
    <input name="cla" type="password" id="cla" value="" size="60" required>
  </p>
   
  <a href="asesor.php">Regresar</a>
  <p>
    <input type="submit" name="submit" id="submit" value="Registrar">
  </p>
</form>
<?php
	break;
	case "Actualizar":
	//recibo los campos del formulario proveniente con el método POST
	$cod = $_POST['cod'];
	$usu = $_POST['usu'];
	$nom = $_POST['nom'];
	$ape = $_POST['ape'];
	//Instrucción SQL que permite insertar en la BD
	$sql = "UPDATE cita_asesor SET nombre='".$nom."', apellido='".$ape."', usuario='".$usu."' WHERE  cedula='".$cod."';";
	//Se conecta a la BD y luego ejecuta la instrucción SQL
	if ($actualizar = $mysqli->query($sql)) {
	//Validamos si el registro fue ingresado con éxito
	echo 'Modificación exitosa';
	echo '<meta http-equiv="refresh" content="1; url=asesor.php" />';
	}
	else {echo 'Modificacion fallida';}
	echo '<meta http-equiv="refresh" content="2; url=asesor.php" />';
	break;
	case "Modificar":
	$sql = 'SELECT `cedula`, `nombre`, `apellido`, `usuario` FROM `cita_asesor` WHERE cedula ='.$_POST['cod'].' Limit 1';
	$consulta = $mysqli->query($sql);
	if($row=$consulta->fetch_assoc())
{	
	?>
    <form id="form1" name="form1" method="post" action="asesor.php">
  <h1>Modificar</h1>
  <p>
    <label for="cod">Cedula:</label>
    <?php  echo $row['cedula']; ?>
    <input name="cod" type="hidden" id="cod" value="<?php echo $row['cedula']; ?>" size="120" required>
  </p>
  <p>
    <label for="nom">Nombre:</label>
    <input name="nom" type="text" id="nom" value="<?php echo $row['nombre']; ?>" size="120" required>
  </p>
  <p>
    <label for="ape">Apellido:</label>
    <input name="ape" type="text" id="ape" value="<?php echo $row['apellido']; ?>" size="60" required>
  </p>
    <p>
    <label for="ape">Usuario:</label>
    <input name="ape" type="text" id="ape" value="<?php echo $row['usuario']; ?>" size="60" required>
  </p>
  <p>
    <label for="cla_ant">Clave anterior:</label>
    <input name="cla_ant" type="password" id="cla_ant" value="" size="60" required>
  </p>
    <p>
    <label for="cla_nue">Clave nueva:</label>
    <input name="cla_nue" type="password" id="cla_nue" value="" size="60" required>
  </p>
    <p>
    <label for="cla_nue2">Confirme clave nueva:</label>
    <input name="cla_nue2" type="password" id="cla_nue2" value="" size="60" required>
  </p>
  <a href="asesor.php">Regresar</a>
  <p>
    <input type="submit" name="submit" id="submit" value="Actualizar">
  </p>
</form>
	<?php
	}
	break;
	case "Eliminar":
		//Instrucción SQL que permite eliminar en la BD
		$sql = 'DELETE FROM cita_asesor WHERE cedula="'.$_POST['cod'].'"';
		//Se conecta a la BD y luego ejecuta la instrucción SQL
		if ($eliminar = $mysqli->query($sql)){
		
		//Validamos si el registro fue eliminado con éxito 
		echo 'Registro eliminado';echo '<meta http-equiv="refresh" content="1; url=asesor.php" />';}
		else {echo 'Eliminación fallida, por favor compruebe que la usuario no esté en uso';echo '<meta http-equiv="refresh" content="2; url=asesor.php" />';}
	break;
	default:
	echo "Ingreso erroneo";
	break;
	}//fin switch
}else{
$sql = 'SELECT `cedula`, `nombre`, `apellido` FROM `cita_asesor`';
$consulta = $mysqli->query($sql);
?>
</p>
<h1 class="h">usuario</h1>
<div class="datagrid3" id="tg<?php echo $nombretabla ?>"><div id="DivRoot<?php echo $nombretabla ?>" align="left">
    <div style="overflow: hidden;" id="DivHeaderRow<?php echo $nombretabla ?>">
    </div>
     <div style="overflow:scroll;" onscroll="OnScrollDiv(this,'<?php echo $nombretabla ?>')" id="DivMainContent<?php echo $nombretabla ?>">
        <!--Place Your Table Heare-->
     <table border="1" id="tb<?php echo $nombretabla ?>">
    <thead>
  <tr>
    <th>Identificación</th>
    <th>Asesor</th>
    <th colspan="2"><?php echo btn("asesor.php",0,"Nuevo");?></th>
</tr>
</thead><tbody>
<?Php
$contador = 1; 
while($row=$consulta->fetch_assoc())
{	
	if ($contador % 2 == 0) echo '<tr class="par">';
	else echo '<tr class="impar">';	echo '<td>'.$row['cedula'].'</td>';
	echo '<td>'.$row['nombre'].' '.$row['apellido'].'</td>';
	echo '<td>'.btn("asesor.php",$row['cedula'],"Modificar").'</td>';
    echo '<td>'.btn("asesor.php",$row['cedula'],"Eliminar").'</td>';
    echo'</tr>'; 
	$contador ++;
	 }//fin while
}//fin else if isset cod
?>
</tbody>
</table>
        <!--<table id"idtabla"><tr><td>.......</td></tr></table>-->
    </div><!--DivMainContent-->
    </div><!--DivRoot-->
    <div id="DivFooterRow<?php echo $nombretabla ?>" style="overflow:hidden">
    </div><!--datagrid3-->
</body>
</html>
    </div><!--datagrid3-->
</body>
</html>