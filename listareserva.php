<?php
session_start();
if (!isset($_SESSION['identificacion'])){
echo '<meta http-equiv="refresh" content="0; url=index.php" />';
exit();
}
?>
<!doctype html> 
<html lang="es"> 
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width;initial-scale=1"/> 
        <title>Citas para Asesoría</title> 
		<link rel="stylesheet" href="estilo.css"> 
        <script type="text/javascript" src="js/funciones.js"></script>
        <script>
function reservar(n) {
		if (confirm('Esta seguro de reservar esta cita?')) {
		window.location="reservar.php?franja="+n;
    }
}

</script>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/calendario.css">

<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/calendario.js"></script>
	<script type="text/javascript">
		$(function(){
		$("#fecha").datepicker({
				changeMonth:true,
				changeYear:true,
				showOn: "button",
				buttonImage: "css/images/ico.png",
				buttonImageOnly: true,
				showButtonPanel: true,
				dateFormat: "dd-mm-yy"
			})
		})
	</script>

	</head>
	<body onLoad="consultarcitas();"> 
	
<?php
require('conex.php');
require ("function.php");
require ("funciones_reserva.php");
echo menu();
?>
Fecha: <input type="date"  value = "<?php echo date ('d-m-Y'); ?>" name="fecha" id="fecha" onChange ="consultarcitas();tfechas.checked = false"/>
<p>

    <input name="tfechas" id ="tfechas" type="checkbox"  onClick="if(tfechas.checked == true){
    limpiar('fecha');}else{ fechahoy();}consultarcitas();" value="">
todas las fechas
</p>
Asesor: <?php
$sql = "SELECT `cedula`, `nombre`, `apellido` FROM `cita_asesor`";
//echo $sql;
$consulta = $mysqli->query($sql);
?>
<select name="asesor" id="asesor" onChange ="consultarcitas();">
<option value="0">Todos los asesores</option>
<?php
while ($datos=$consulta->fetch_assoc())
{
?>
<option value="<?php echo $datos['cedula']; ?>"><?php echo $datos['nombre']." ".$datos['apellido']; ?></option>
<?php
}
?>
</select> <label for="grupo">Jornadas de Atención:</label>
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
</select><BR>
<div align="center" id="txtsugerencias"></div>
</div>
</body>
</html>