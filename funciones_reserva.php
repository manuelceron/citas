<?php
if (isset($_POST['asesor'])){
$asesor = $_POST['asesor'];
}else{
$asesor = 0;	
}
if (isset($_POST['fecha'])){
	$fecha = $_POST['fecha'];
}else{
	$fecha = date("Y-m-d");
}
$horario=0;
if (isset($_POST['horario'])){
	$horario = $_POST['horario'];
}
//horario

//echo $fecha;
if (isset($_POST['asesor']) or isset($_POST['fecha']) or isset($_POST['horario'])){
citasporfecha($fecha,$asesor,$horario);
}
function citasporfecha($fec="",$ase=0,$hor=0){
require('conex.php');
$asesor = "";
if ($ase<>0) $asesor = " and cita_asesor.cedula=".$ase;
$horario = "";
if ($hor<>0) $horario = " and cita_grupo.id_grupo=".$hor;
$fecha = "";	
if ($fec<>""){
    $date = date_create($fec);
    $fec = date_format($date, 'Y-m-d');
    $fecha = " and cita_franja.fecha='".$fec."'";
}

$sql = 'SELECT cita_asesor.nombre, cita_asesor.apellido, cita_franja.fecha, cita_franja.hora_inicio, cita_franja.hora_fin, cita_franja_asesor.estado, cita_franja_asesor.id, `cita_grupo`.`nombre` as grupo FROM cita_franja, cita_franja_asesor, cita_asesor, `cita_grupo` WHERE `cita_grupo`.`id_grupo`=`cita_franja`.`grupo` and cita_asesor.cedula = cita_franja_asesor.id_asesor and cita_franja.id =  cita_franja_asesor.id_franja and cita_franja_asesor.estado = "Disponible" '.$asesor.$fecha.$horario.";";
//, `cita_grupo`.`nombre` as grupo FROM `cita_franja`,`cita_grupo` WHERE `cita_grupo`.`id_grupo`=`cita_franja`.`grupo`
//echo $sql;
$consulta = $mysqli->query($sql);
?>
</p>
<h1 class="h">Franjas disponibles</h1>
<p>Seleccione su franja</p>
<div id="tabla">
<table border="2">
<thead>
  <tr>
    <th>Franja</th>
    <th>Fecha</th>
    <th>Asesor</th>
    <th>Horario de Atención</th>
    <th>Acciones</th>
</tr>
</thead>
<tbody>
<?php
$contador = 1; 
$dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
while($row=$consulta->fetch_assoc())
{	
$date = date_create($row['fecha']);
$ndia = $dias[(date_format($date, 'w'))];
$fecha_cita = $ndia." ".date_format($date, 'd \d\e ');
$fecha_cita .= $meses[date_format($date, 'm')-1];
$fecha_cita .= date_format($date, ' \d\e Y');
	if ($contador % 2 == 0) echo '<tr class="par">';
	else echo '<tr class="impar">';
	echo '<td>',$row['hora_inicio']," - ",$row['hora_fin'],'</td>';
	echo '<td>',$fecha_cita,'</td>';
	echo '<td>'.$row['nombre']." ".$row['apellido'].'</td>';
	echo '<td>'.$row['grupo'].'</td>';
	echo '<td><button onclick="reservar('.$row['id'].')">Reservar</button></td>';
    echo'</tr>';	
	$contador ++; 
}
?>
<tbody>
</table>
<?php
}
?>