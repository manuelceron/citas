<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Citas para Asesoría</title> 
<link rel="stylesheet" href="estilo.css"> 
</head>

<body>
<?php
require ('conex.php');
require ('function.php');
echo menu();
if(isset($_POST['cod'])){
$sql = 'SELECT `cita_cita`.`identificacion_estudiante`, `cita_estudiante`.`nombre`, `cita_estudiante`.`apellido`, `cita_cita`.`franja`, `cita_cita`.`observacion`, `cita_cita`.`inicio_cita`, `cita_cita`.`fin_cita`, `cita_asesor`.`nombre` as nom_asesor,`cita_asesor`.`apellido` as ape_asesor, `cita_franja`.`fecha`, cita_franja.hora_inicio, cita_franja.hora_fin FROM `cita_cita`, `cita_estudiante`, `cita_asesor`,`cita_franja_asesor`, `cita_franja` WHERE `cita_cita`.`identificacion_estudiante` = `cita_estudiante`.`identificacion` and `cita_asesor`.`cedula` = `cita_franja_asesor`.`id_asesor` and `cita_franja_asesor`.`id` = `cita_cita`.`franja` and `cita_franja`.`id` = `cita_franja_asesor`.`id_franja` and `cita_estudiante`.`identificacion` = '.$_POST['cod'];
if ($consulta = $mysqli->query($sql)){
?>
</p>
<h1 class="h">Estudiante</h1>
<div align="center">
<table border="2">
  <tr>
	<th>Estudiante</th>
    <th>Cita</th>
    <th>Asesor</th>
    <th>Observación</th>
</tr>
<?php
$dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
$contador = 1;
while($row=$consulta->fetch_assoc())
{	
$date = date_create($row['fecha']);
$ndia = $dias[(date_format($date, 'w'))];
$fecha_cita = $ndia." ".date_format($date, 'd \d\e m \d\e Y');
	if ($contador % 2 == 0) echo '<tr class="par">';
	else echo '<tr class="impar">';
	echo '<td>'.$row['identificacion_estudiante'].'<BR>';
	echo $row['nombre'].' '.$row['apellido'].'</td>';
	echo '<td>'.$fecha_cita.'<BR>'.$row['hora_inicio']." - ".$row['hora_fin'].'</td>';
	echo '<td>'.$row['nom_asesor']." ".$row['nom_asesor'].'</td>';
	echo '<td>'.$row['observacion'].'</td>';
    echo'</tr>';
	$contador ++; 
}
?>
</table></div>
<?php }
}
else {
?>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p>Consultar Cita</p>
  <p>Identificación: 
    <label for="cod"></label>
    <input type="text" name="cod" id="cod" required title="Por favor escriba su documento de identidad"/>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Consultar" />
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } ?>
</body>
</html>