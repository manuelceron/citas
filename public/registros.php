<?Php require('conex.php'); 
require('function.php');

if (isset($_POST['cancelar'])){
?>
<script type="text/javascript">
alert ('<?php echo $_POST['cancelar']; ?>');
</script> 
<?php
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Citas para Asesoría</title> 
<link rel="stylesheet" href="estilo.css"> 
</head>
<body>
<p>
  <?php
echo menu();
$sql = 'SELECT `cita_cita`.`identificacion_estudiante`, `cita_estudiante`.`nombre`, `cita_estudiante`.`apellido`, `cita_cita`.`franja`, `cita_cita`.`observacion`, `cita_cita`.`inicio_cita`, `cita_cita`.`fin_cita`, `cita_asesor`.`nombre` as nombreasesor, `cita_asesor`.`apellido` as apellidoasesor, `cita_franja`.`fecha`, `cita_franja`.`fecha`, cita_franja.hora_inicio, cita_franja.hora_fin FROM `cita_cita`, `cita_estudiante`, `cita_asesor`,`cita_franja_asesor`, `cita_franja` WHERE `cita_cita`.`identificacion_estudiante` = `cita_estudiante`.`identificacion` and `cita_asesor`.`cedula` = `cita_franja_asesor`.`id_asesor` and `cita_franja_asesor`.`id` = `cita_cita`.`franja` and `cita_franja`.`id` = `cita_franja_asesor`.`id_franja`';
//echo $sql;
$consulta = $mysqli->query($sql);
?>
</p>
<h1 class="h">Estudiantes</h1>
<table border="2">
  <tr>
    <th>Estudiante</th>
    <th>Cita</th>
    <th>Asesor</th>
    <th>Observación</th>
    <th>Acciones</th>
</tr>
<?php
$contador = 1;
$dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
while($row=$consulta->fetch_assoc())
{	
$date = date_create($row['fecha']);
$ndia = $dias[(date_format($date, 'w'))];
$fecha_cita = $ndia." ".date_format($date, 'd \d\e m \d\e Y');
$boton1 ='<a href="registros.php?cancelar='.$row['identificacion_estudiante'].'&franja='.$row['franja'].'">Cancelar</a>';
$boton2 = '<form id="form'.$row['identificacion_estudiante'].'" name="form'.$row['identificacion_estudiante'].'" method="post" action="registros.php">
  <input name="cancelar" type="hidden" id="cancelar" value="'.$row['identificacion_estudiante'].'">
  <input type="submit" name="Cancelar" id="Cancelar" onClick="enviar_formulario(form'.$row['identificacion_estudiante'].');" value="Cancelar cita"></form>';
	if ($contador % 2 == 0) echo '<tr class="par">';
	else echo '<tr class="impar">';
	echo '<td>'.$row['identificacion_estudiante'].'<BR>';
	echo $row['nombre'].' ';
	echo $row['apellido'].'</td>';
	echo '<td>'.$fecha_cita.'<BR>'.$row['hora_inicio']." - ".$row['hora_fin'].'</td>';
	echo '<td>'.$row['nombreasesor']." ".$row['apellidoasesor'].'</td>';
	echo '<td>'.$row['observacion'].'</td>';
	echo '<td>'.$boton1.'</td>';
    echo'</tr>';
	$contador ++;
}
?>
</table>
</body>
</html>