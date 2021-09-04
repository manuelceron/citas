<link rel="stylesheet" type="text/css" href="css/estilo.css" /><!--tablas--->
<link rel="stylesheet" href="estilo.css"> 
<?php
require('conex.php');
require ('function.php');

echo menu();
$nombretabla = "cita_franja";
$nombrearchivo = "franja";
$titulo = "Franjas";
$llave = "id";
$nombre = "hora_inicio";
$ultimo = "grupo";
$campos = array();
$campos['hora_inicio'] = 'Hora de Inicio';
$campos['hora_fin'] = 'Hora de Fin';
$campos['fecha'] = 'Fecha';
$campos['grupo'] = 'Horario de Atención';
?>
<?php
if (isset($_POST['del'])){
	//Instrucción SQL que permite eliminar en la BD
		$sql = 'DELETE FROM '.$nombretabla.' WHERE '.$llave.'="'.$_POST['del'].'"';
		//Se conecta a la BD y luego ejecuta la instrucción SQL
		if ($eliminar = $mysqli->query($sql)) {
		//echo $sql;
		//Validamos si el registro fue eliminado con éxito
		echo 'Registro eliminado';echo '<meta http-equiv="refresh" content="1; url='.$nombrearchivo.'.php" />';}
		else {echo 'Eliminación fallida, por favor compruebe que la usuario no esté en uso';echo '<meta http-equiv="refresh" content="2; url='.$nombrearchivo.'.php" />';}
}
//require('funciones.php');

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" /><!--estilos--->
<title><?php echo $titulo ?></title>
<style type="text/css">
.h {
	font-family: Comic Sans MS, cursive;
}
</style>
<script language="javascript" src="js/funciones.js"></script>
</head>

<body>
<p align="center">
<h1><?php echo $titulo ?></h1>
<br>
<p>
  <?php
if (isset($_POST['submit'])){
	switch ($_POST['submit']){
	case "Registrar":
	//recibo los campos del formulario proveniente con el método POST
	$sql = 'INSERT INTO '.$nombretabla.'(`'.$llave.'`,';
foreach($campos as $valor=>$value)
{
			$sql.= "`".$valor."`";
			if ($valor!=$ultimo){
				$sql .= ", ";
			}else{
			break;
			}
			
}
$sql .= ')';
$sql .= " VALUES(NULL,";
foreach($campos as $valor=>$value)
{
			$sql.= "'".$_POST[$valor]."'";
			if ($valor!=$ultimo){
			$sql .= ", ";
			}else{
			break;
			}
}
$sql .= ')';
//echo $sql;
if ($insertar = $mysqli->query($sql)) {
	//Validamos si el registro fue ingresado con éxito
	echo 'Registro exitoso';
	echo '<meta http-equiv="refresh" content="1; url='.$nombrearchivo.'.php" />';
	}
	else {echo 'Registro fallido'; echo $sql;}
	
	break;
	case "Nuevo":
	echo "Ingresando un ";
	echo $_POST['submit'];
	?>
	<form id="form1" name="form1" method="post" action="franja.php">
  <h1>Registrar</h1><p>
    <label for="hora_inicio">Hora de Inicio:</label>
    <input name="hora_inicio" type="time" id="hora_inicio" value="" required>
  </p><p>
    <label for="hora_fin">Hora de Fin:</label>
    <input name="hora_fin" type="time" id="hora_fin" value="" required>
  </p><p>
    <label for="fecha">Fecha:</label>
    <input name="fecha" type="date" id="fecha" value="" required>
  </p>
  <p>
  	<p>
    <label for="grupo">Horario de Atención:</label>
<?php
$sql = "SELECT `id_grupo`, `nombre` FROM `cita_grupo`";
//echo $sql;
$consulta = $mysqli->query($sql);
?>
<select name="grupo" id="grupo" onChange ="consultarcitas();">
<option value="0">Todos los Grupos</option>
<?php
while ($datos=$consulta->fetch_assoc())
{
?>
<option value="<?php echo $datos['id_grupo']; ?>"><?php echo $datos['nombre']; ?></option>
<?php
}
?>
</select>
  </p>
  <a href="franja.php">Regresar</a>
  <p>
    <input type="submit" name="submit" id="submit" value="Registrar">
  </p>
</form>
<?php
	break;
	case "Actualizar":
	//recibo los campos del formulario proveniente con el método POST
	$cod = $_POST['cod'];
	//Instrucción SQL que permite insertar en la BD sig_tipo_documento`, `nom_tipo_documento
	$sql = "UPDATE ".$nombretabla." SET ";
	foreach($campos as $valor=>$value)
{
			$sql.= $valor."='".$_POST[$valor]."'";
			if ($valor!=$ultimo){
				$sql .= ", ";
			}else{
			break;
			}
			
}
	$sql .= "WHERE  ".$llave."='".$cod."';";
	//echo $sql;
	//Se conecta a la BD y luego ejecuta la instrucción SQL
	if ($actualizar = $mysqli->query($sql)) {
	//Validamos si el registro fue ingresado con éxito
	echo 'Modificación exitosa';
	echo '<meta http-equiv="refresh" content="1; url='.$nombrearchivo.'.php" />';
	}
	else {echo 'Modificacion fallida';}
	echo '<meta http-equiv="refresh" content="2; url='.$nombrearchivo.'.php" />';
	break;
	case "Modificar":
	$sql = "SELECT `".$llave."`, ";
foreach($campos as $valor=>$value)
{
			$sql.= "`".$valor."`";
			if ($valor!=$ultimo){
				$sql .= ", ";
			}else{
			break;
			}
			
}
$sql .= " FROM `".$nombretabla."`".' WHERE '.$llave.' ='.$_POST['cod'].' Limit 1';
	$consulta = $mysqli->query($sql);
	//echo $sql;
	if($row=$consulta->fetch_assoc())
{	
	echo '<form id="form1" name="form1" method="post" action="'.$nombrearchivo.'.php">
  <h1>Modificar '.$row[$llave].'</h1>';
?>
<p> <input name="cod" type="hidden" id="cod" value="<?php echo $row[$llave] ?>">
    <label for="hora_inicio">Hora de Inicio:</label>
    <input name="hora_inicio" type="time" id="hora_inicio" value="<?php echo $row['hora_inicio'] ?>" required>
  </p><p>
    <label for="hora_fin">Hora de Fin:</label>
    <input name="hora_fin" type="time" id="hora_fin" value="<?php echo $row['hora_fin'] ?>" required>
  </p><p>
    <label for="fecha">Fecha:</label>
    <input name="fecha" type="date" id="fecha" value="<?php echo $row['fecha'] ?>" required>
  </p>
    <label for="grupo">Horario de Atención:</label>
	<?php
	$sql = "SELECT `id_grupo`, `nombre` FROM `cita_grupo`";
	//echo $sql;
	$consulta = $mysqli->query($sql);
	?>
	<select name="grupo" id="grupo" onChange ="consultarcitas();">
	<option value="0">Todos los Grupos</option>
	<?php
	while ($datos=$consulta->fetch_assoc())
	{
	?>
	<option <?php
	if ($row['grupo']==$datos['id_grupo']){
		echo "selected ";
	}
	?>value="<?php echo $datos['id_grupo']; ?>"><?php echo $datos['nombre']; ?></option>
	<?php
	}
	?>
	</select>
  </p>
  <a href="franja.php">Regresar</a>
  <p>
    <input type="submit" name="submit" id="submit" value="Actualizar">
  </p>
</form>
<?php
	}
	break;
	default:
	echo "Ingreso erroneo";	
	}//fin switch
}else{

$sql = "SELECT `cita_franja`.`id`, `cita_franja`.`hora_inicio`, `cita_franja`.`hora_fin`, `cita_franja`.`fecha`, `cita_grupo`.`nombre` as grupo FROM `cita_franja`,`cita_grupo` WHERE `cita_grupo`.`id_grupo`=`cita_franja`.`grupo` ORDER BY `cita_franja`.`id`";
//echo $sql;
//$sql="SELECT `".$llave."`, `identificacion`, `tipo_identificacion`, `nombre`, `apellido`, `direccion`, `telefono`, `correo`, `municipio` FROM `".$nombretabla."` ORDER BY `".$llave."`";
$consulta = $mysqli->query($sql);
//echo $sql;
?>
</p>
<div align="center">
     <table border="1" id="tb<?php echo $nombretabla ?>">
    <thead>
  <tr>
    <?php
	foreach($campos as $valor=>$value)
{
			//$sql.= "`".$value."`";
			if ($valor!=$ultimo){
				echo "<th>".$value."</th>";
			}else{
				echo "<th>".$value."</th>";
			break;
			}
			
}
	?>
    <th colspan="2"><?php echo '<form id="formNuevo" name="formNuevo" method="post" action="'.$nombrearchivo.'.php">
	<input name="cod" type="hidden" id="cod" value="0">
	<input type="submit" name="submit" id="submit" value="Nuevo">
	</form>'; ?></td></th>
</tr>
</thead><tbody>
<?php
$contador = 1; 
while($row=$consulta->fetch_assoc())
{	
	if ($contador % 2 == 0) echo '<tr class="par">';
	else echo '<tr class="impar">';
	foreach($campos as $valor=>$value)
{
			$sql.= "`".$value."`";
			if ($valor!=$ultimo){
				echo "<td>".$row[$valor]."</td>";
			}else{
				echo "<td>".$row[$valor]."</td>";
			break;
			}
			
}
	echo '<td><form id="formModificar" name="formModificar" method="post" action="'.$nombrearchivo.'.php">
	<input name="cod" type="hidden" id="cod" value="'.$row[$llave].'">
	<input type="submit" name="submit" id="submit" value="Modificar">
	</form></td>';
	?>
    <td><input type="image" src="img/eliminar.png" onClick="confirmeliminar('<?php echo $nombrearchivo; ?>.php',{'del':'<?php echo $row[$llave];?>'},'<?php echo $row[$nombre];?>');" value="Eliminar"></td>
	<?php
    echo'</tr>'; 
	$contador ++; 
	 }//fin while
}//fin else if isset cod
?>
</tbody>
</table>
</div>
</body>
</html>
