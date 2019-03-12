<title>Citas para Asesoría</title>
<?php
require ('conex.php');
if(isset($_POST['cod'])){
$datosrecibidos = $_POST['cod'];
$sql = 'select `nombre`, `apellido` from `cita_estudiante` where `identificacion` ="'.$datosrecibidos.'"';
if ($consulta = $mysqli -> query ($sql)){
while ( $row = $consulta -> fetch_assoc()) {
echo "Bienvenid@..".$sugerencia = $row['nombre'].'   '.$row['apellido'];
}
}
else {
	
echo "lo sentimos no te encuentras registrado :(  te invitamos a registrarte" ;
}
exit();
}
?>