<?php require('conex.php'); 
require('function.php');
$nombretabla = "estudiante";
session_start();
if(!isset($_SESSION['asesores_usu'])){
exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--script language="javascript" type="text/javascript" src="js/tabla.js"></script><!--scroll--->
<!--link rel="stylesheet" type="text/css" href="css/tabla.css" /><!--tablas--->
<link rel="stylesheet" type="text/css" href="css/estilo.css" /><!--tablas--->
<link rel="stylesheet" href="estilo.css"> 
<title>Mis Proyectos</title>
<style type="text/css">
.h {
	font-family: Comic Sans MS, cursive;
}
</style>
</head>

<body>
<p align="center">

  <?php
menu();
if(isset($_SESSION['asesores_usu'])){
if ($_SESSION['asesores_tipo']=="admin"){
}else{
	echo "No tiene los permisos para administrar asesores";
	exit();
}
}
?>
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
	//Instrucción SQL que permite insertar en la BD
	$sql = 'INSERT INTO cita_estudiante(`identificacion`, `nombre`, `apellido`) 
	VALUES("'.$cod.'","'.$nom.'","'.$ape.'")';
	//echo $sql;
	//Se conecta a la BD y luego ejecuta la instrucción SQL
	if ($insertar = $mysqli->query($sql)) {
	//Validamos si el registro fue ingresado con éxito
	echo 'Registro exitoso';
	echo '<meta http-equiv="refresh" content="1; url=estudiante.php" />';
	}
	else {echo 'Registro fallido';}
	
	break;
	case "Nuevo":
	echo "Ingresando un ";
	echo $_POST['submit'];
	?>
<form id="form1" name="form1" method="post" action="estudiante.php">
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
  <a href="estudiante.php">Regresar</a>
  <p>
    <input type="submit" name="submit" id="submit" value="Registrar">
  </p>
</form>
<?php
	break;
	case "Actualizar":
	//recibo los campos del formulario proveniente con el método POST
	$cod = $_POST['cod'];
	$nom = $_POST['nom'];
	$ape = $_POST['ape'];
	//Instrucción SQL que permite insertar en la BD
	$sql = "UPDATE cita_estudiante SET nombre='".$nom."', apellido='".$ape."' WHERE  identificacion='".$cod."';";
	//Se conecta a la BD y luego ejecuta la instrucción SQL
	if ($actualizar = $mysqli->query($sql)) {
	//Validamos si el registro fue ingresado con éxito
	echo 'Modificación exitosa';
	echo '<meta http-equiv="refresh" content="1; url=estudiante.php" />';
	}
	else {echo 'Modificacion fallida';}
	echo '<meta http-equiv="refresh" content="2; url=estudiante.php" />';
	break;
	case "Modificar":
	$sql = 'SELECT `identificacion`, `nombre`, `apellido` FROM `cita_estudiante` WHERE identificacion ='.$_POST['cod'].' Limit 1';
	//echo $sql;
	$consulta = $mysqli->query($sql);
	if($row=$consulta->fetch_assoc())
{	
	?>
    <form id="form1" name="form1" method="post" action="estudiante.php">
  <h1>Modificar</h1>
  <p>
    <label for="cod">Cedula:</label>
    <?php  echo $row['identificacion']; ?>
    <input name="cod" type="hidden" id="cod" value="<?php echo $row['identificacion']; ?>" size="120" required>
  </p>
  <p>
    <label for="nom">Nombre:</label>
    <input name="nom" type="text" id="nom" value="<?php echo $row['nombre']; ?>" size="120" required>
  </p>
  <p>
    <label for="ape">Apellido:</label>
    <input name="ape" type="text" id="ape" value="<?php echo $row['apellido']; ?>" size="60" required>
  </p>
  <a href="estudiante.php">Regresar</a>
  <p>
    <input type="submit" name="submit" id="submit" value="Actualizar">
  </p>
</form>
	<?php
	}
	break;
	case "Eliminar":
		//Instrucción SQL que permite eliminar en la BD
		$sql = 'DELETE FROM cita_estudiante WHERE identificacion="'.$_POST['cod'].'"';
		//Se conecta a la BD y luego ejecuta la instrucción SQL
		if ($eliminar = $mysqli->query($sql)){
		
		//Validamos si el registro fue eliminado con éxito
		echo 'Registro eliminado';echo '<meta http-equiv="refresh" content="1; url=estudiante.php" />';}
		else {echo 'Eliminación fallida, por favor compruebe que la usuario no esté en uso';echo '<meta http-equiv="refresh" content="2; url=estudiante.php" />';}
	break;
	default:
	echo "Ingreso erroneo";
	break;
	}//fin switch
}else{
$sql = 'SELECT `identificacion`, `nombre`, `apellido` FROM `cita_estudiante`';
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
    <th>Estudiante</th>
    <th colspan="2"><?php echo btn("estudiante.php",0,"Nuevo");?></th>
</tr>
</thead><tbody>
<?Php
$contador = 1; 
while($row=$consulta->fetch_assoc())
{	
	if ($contador % 2 == 0) echo '<tr class="par">';
	else echo '<tr class="impar">';
	echo '<td>'.$row['identificacion'].'</td>';
	echo '<td>'.$row['nombre'].' '.$row['apellido'].'</td>';
	echo '<td>'.btn("estudiante.php",$row['identificacion'],"Modificar").'</td>';
    echo '<td>'.btn("estudiante.php",$row['identificacion'],"Eliminar").'</td>';
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