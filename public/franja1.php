<?php require('conex.php'); 
require('function.php');
$nombretabla = "franja";
?>

<!doctype html> 
<html lang="es"> 
<head>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width;initial-scale=1"/> 
        <title>Franjas</title> 
<script language="javascript" type="text/javascript" src="js/tabla.js"></script><!--scroll--->
<!--link rel="stylesheet" type="text/css" href="css/tabla.css" /><!--tablas--->
<link rel="stylesheet" type="text/css" href="css/estilo.css" /><!--tablas--->
<link rel="stylesheet" href="estilo.css"> 
<style type="text/css">
.h {
	font-family: Comic Sans MS, cursive;
}
</style>
</head>
<body>
<p align="center">
<h1 class="titulos">Franjas</h1>
<p>
  <?php
menu();
if (isset($_POST['submit'])){
	switch ($_POST['submit']){
	case "Registrar":
	//recibo los campos del formulario proveniente con el método POST
	$id = $_POST['id'];
	$hin = $_POST['hin'];
	$hfi = $_POST['hfi'];
	$fec = $_POST['fec'];
	//Instrucción SQL que permite insertar en la BD
	$sql = 'INSERT INTO estudiante(SELECT `id`, `hora_inicio`, `hora_fin`, `fecha` FROM `franja`) VALUES(NULL,"$hin", "$hfi", "$fec")';
	echo $sql;
	//Se conecta a la BD y luego ejecuta la instrucción SQL
	if ($insertar = $mysqli->query($sql)) {
	//Validamos si el registro fue ingresado con éxito
	echo 'Registro exitoso';
	echo '<meta http-equiv="refresh" content="1; url=franja.php" />';
	}
	else {echo 'Registro fallido';}
	
	break;
	case "Nuevo":
	echo "Ingresando un ";
	echo $_POST['submit'];
	?>
<form id="form1" name="form1" method="post" action="franja.php">
  <h1>Registrar</h1>
  <p>
    <label for="hin">Hora de Inicio:</label>
    <input name="hin" type="time" id="hin"  size="12" maxlength="12" required>
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
	$sql = "UPDATE estudiante SET nombre='".$nom."', apellido='".$ape."' WHERE  cedula='".$cod."';";
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
	$sql = 'SELECT `identificacion`, `nombre`, `apellido` FROM `estudiante` WHERE cedula ='.$_POST['cod'].' Limit 1';
	$consulta = $mysqli->query($sql);
	if($row=$consulta->fetch_assoc())
{	
	?>
    <form id="form1" name="form1" method="post" action="estudiante.php">
  <h1>Modificar</h1>
  <p>
    <label for="cod">Cedula:</label>
    <?php  echo $row['cedula']; ?>
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
		$sql = 'DELETE FROM estudiante WHERE cedula="'.$_POST['cod'].'"';
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
$sql = 'SELECT `identificacion`, `nombre`, `apellido` FROM `estudiante`';
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
	echo '<td>'.btn("estudiante.php",$row['cedula'],"Modificar").'</td>';
    echo '<td>'.btn("estudiante.php",$row['cedula'],"Eliminar").'</td>';
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



<?php
require('conex.php');
require ("function.php");
echo menu();
$sql = 'SELECT `id`, `hora_inicio`, `hora_fin`, `fecha` FROM `franja`';
$consulta = $mysqli->query($sql);
?>
</p>
<h1 class="h">Franjas Docentes</h1>
<div id="tabla">
<table border="2">
<thead>
  <tr>
    <th>Franja</th>
    <th>Hora Inicio</th>
    <th>Hora Fin</th>
    <th>Fecha</th>
    <th colspan="2"><?php echo btn("franja.php",0,"Nuevo");?></th>
</tr>
</thead>
<tbody>
<?php
$contador = 1; 
while($row=$consulta->fetch_assoc())
{	
	if ($contador % 2 == 0) echo '<tr class="par">';
	else echo '<tr class="impar">';
	echo '<td>'.$row['id'].'</td>';
	echo '<td>'.$row['hora_inicio'].'</td>';
	echo '<td>'.$row['hora_fin'].'</td>';
	echo '<td>'.$row['fecha'].'</td>';
	echo '<td>'.btn("franja.php",$row['id'],"Modificar").'</td>';
    echo '<td>'.btn("franja.php",$row['id'],"Eliminar").'</td>';
    echo'</tr>';	
	$contador ++; 
}
?>
<tbody>
</table>
</div>
</body>
</html>