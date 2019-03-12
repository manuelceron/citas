<!doctype html> 
<html lang="es"> 
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width;initial-scale=1"/> 
        <title>Citas</title> 
		<link rel="stylesheet" href="estilo.css"> 
        <script>
function myFunction(n) {
    var person = prompt("Por favor escriba su número de identificación", "");
    
    if (person != null) {
		window.location="reservar.php?estudiante="+person+"&franja="+n;
    }
}

</script>
	</head>
	<body> 
<?php
require('conex.php');
require ("function.php");
echo menu();
$sql = 'SELECT CONCAT(asesor.nombre, " ", asesor.apellido) as nomasesor, franja.fecha, DATE_FORMAT(franja.hora_inicio, "%l:%i %p") as hora_inicio, DATE_FORMAT(franja.hora_fin, "%l:%i %p") as hora_fin, franja_asesor.estado, franja_asesor.id FROM franja, franja_asesor, asesor WHERE asesor.cedula = franja_asesor.id_asesor and franja.id =  franja_asesor.id_franja and franja_asesor.estado = "Disponible"';
$consulta = $mysqli->query($sql);
?>
</p>
<h1 class="h">Citas Estudiantes</h1>
<div id="tabla">
<table border="2">
<thead>
  <tr>
    <th>Franja</th>
    <th>Fecha</th>
    <th>Asesor</th>
    <th>Acciones</th>
</tr>
</thead>
<tbody>
<?php
$contador = 1; 
$dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
while($row=$consulta->fetch_assoc())
{	
$date = date_create($row['fecha']);
$ndia = $dias[(date_format($date, 'w'))];
$fecha_cita = $ndia." ".date_format($date, 'd \d\e m \d\e Y');
	if ($contador % 2 == 0) echo '<tr class="par">';
	else echo '<tr class="impar">';
	echo '<td>',$row['hora_inicio']," - ",$row['hora_fin'],'</td>';
	echo '<td>',$fecha_cita,'</td>';
	echo '<td>',$row['nomasesor'],'</td>';
	echo '<td><a href="#" onclick="myFunction('.$row['id'].')">Reservar</a></td>';
    echo'</tr>';	
	$contador ++; 
}
?>
<tbody>
</table>
</div>
</body>


</html>