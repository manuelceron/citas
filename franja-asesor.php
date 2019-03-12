<link rel="stylesheet" type="text/css" href="css/estilo.css" /><!--tablas--->
<link rel="stylesheet" href="estilo.css"> 
<?php
require('conex.php');
require ('function.php');
echo menu();

$nombretabla = "cita_franja_asesor";
$nombrearchivo = "franja-asesor";
$titulo = "Franjas Asesores";
$llave = "id";
$nombre = "id_franja";
$ultimo = "estado";
$campos = array();
$campos['id_franja'] = 'Franja';
$campos['id_asesor'] = 'Asesor';
$campos['estado'] = 'Estado';
//funciones listados
function franjas(){
	require('conex.php'); 
	$sql = 'SELECT id, fecha, hora_inicio, hora_fin FROM cita_franja;';
	$consulta = $mysqli->query($sql);
	$franjas=array();
		while($row=$consulta->fetch_assoc())
		{	
		$id = $row['id'];
		$franja = $row['fecha']." ".$row['hora_inicio']." - ".$row['hora_fin'];
		$franjas[$id] = $franja;
		}
	return $franjas;
}
$franjas = franjas();
function asesores(){
	require('conex.php'); 
	$sql ='SELECT `cedula`, `nombre`, `apellido` FROM `cita_asesor`';
	$consulta = $mysqli->query($sql);
	$asesores=array();
		while($row=$consulta->fetch_assoc())
		{	
		$id = $row['cedula'];
		$asesor = $row['nombre']." ".$row['apellido'];
		$asesores[$id] = $asesor;
		}
	return $asesores;
}
$asesores = asesores();  
$estados = array(); 
$estados['Disponible'] = 'Disponible';
$estados['Ocupado'] = 'Ocupado'
//fin funciones listados
?>
<?php
if (isset($_POST['del'])){
	//Instrucción SQL que permite eliminar en la BD
		$sql = 'DELETE FROM '.$nombretabla.' WHERE '.$llave.'="'.$_POST['del'].'"';
		//Se conecta a la BD y luego ejecuta la instrucción SQL
		if ($eliminar = $mysqli->query($sql)){
		//Validamos si el registro fue eliminado con éxito
		echo 'Registro eliminado';
		echo '<meta http-equiv="refresh" content="1; url='.$nombrearchivo.'.php" />';}
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
<blockquote>
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
	else {echo 'Registro fallido';}
	
	break;
	case "Nuevo":
	echo "Ingresando un ";
	echo $_POST['submit'];
	?>
  </p>
</blockquote>
<form id="form1" name="form1" method="post" action="franja-asesor.php">
  <h1>Registrar</h1><p>
    <label for="id_franja">Franja:</label>
    <?php select($franjas,"id_franja",1); ?>
    <!--input name="id_franja" type="text" id="id_franja" value="" required-->
  </p><p>
    <label for="id_asesor">Asesor:</label>
        <?php select($asesores,"id_asesor"); ?>
    <!--input name="id_asesor" type="text" id="id_asesor" value="" required-->
  </p><p>
    <label for="estado">Estado:</label>
        <?php select($estados,"estado");
	?>
    <!--input name="estado" type="text" id="estado" value="" required-->
  </p><a href="franja-asesor.php">Regresar</a>
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
	?>
	<form id="form1" name="form1" method="post" action="franja-asesor.php">
  <h1>Modificar <?php echo $row[$llave]; ?></h1>  <p>
    <label for="cod">Id:</label>
    <input name="cod" type="hidden" id="cod" value="<?php echo $row[$llave]; ?>" size="120" required>
  </p><p>
    <label for="id_franja">Franja:</label>
	<?php select($franjas,"id_franja",$row['id_franja']); ?>
    <!--input name="id_franja" type="text" id="id_franja" value="4" required-->
  </p><p>
    <label for="id_asesor">Asesor:</label>
    <?php select($asesores,"id_asesor",$row['id_asesor']); ?>
    <!--input name="id_asesor" type="text" id="id_asesor" value="1085290375" required-->
  </p><p>
    <label for="estado">Estado:</label>
    <?php select($estados,"estado",$row['estado']); ?>
    <!--input name="estado" type="text" id="estado" value="Disponible" required-->
  </p><a href="franja-asesor.php">Regresar</a>
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
$sql = 'SELECT cita_franja_asesor.id ,cita_franja.fecha, cita_franja.hora_inicio,cita_franja.hora_fin, cita_asesor.nombre, cita_asesor.apellido, cita_franja_asesor.estado FROM cita_franja_asesor, cita_franja, cita_asesor WHERE cita_franja.id = cita_franja_asesor.id_franja and cita_asesor.cedula = cita_franja_asesor.id_asesor ORDER BY cita_franja_asesor.id';

$consulta = $mysqli->query($sql);
?>
</p>
<div align="center">
     <table border="1" id="tb<?php echo $nombretabla ?>">
    <thead>
  <tr>
    <?php
	echo "<th>Franja</th>";
	echo "<th>Asesor</th>";
	echo "<th>Estado</th>";
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
	$id_franja=$row['fecha']." ".$row['hora_inicio']." - ".$row['hora_fin'];
	echo "<td>".$row['fecha']." ".$row['hora_inicio']." - ".$row['hora_fin']."</td>";
	echo "<td>".$row['nombre']." ".$row['apellido']."</td>";
	echo "<td>".$row['estado']."</td>";
	echo '<td><form id="formModificar" name="formModificar" method="post" action="'.$nombrearchivo.'.php">
	<input name="cod" type="hidden" id="cod" value="'.$row[$llave].'">
	<input type="submit" name="submit" id="submit" value="Modificar">
	</form></td>';
	?>
    <td><input type="image" src="img/eliminar.png" onClick="confirmeliminar('<?php echo $nombrearchivo; ?>.php',{'del':'<?php echo $row[$llave];?>'},'<?php echo $id_franja;?>');" value="Eliminar"></td>
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