<?php require('conex.php');
session_start();
$persona = array('estudiante' => $_SESSION['identificacion'], 'franja' => $_GET['franja']);

$sql = 'INSERT INTO `cita_cita` (`identificacion_estudiante`, `franja`, `observacion`, `inicio_cita`, `fin_cita`) VALUES ('.$_SESSION['identificacion'].', '.$_GET['franja'].', NULL, NULL, NULL)';

if ($consultar = $mysqli->query($sql)){
cambiarestado ("Ocupado");
echo '<script language="javascript">alert("Cita reservada")</script>';
}else{
echo '<script language="javascript">alert("Error al reservar")</script>';

;

}
function cambiarestado ($estado){
require('conex.php');
$sql2 = 'UPDATE `cita_franja_asesor` SET `estado` = "Ocupado" WHERE `cita_franja_asesor`.`id` ='.$_GET['franja'];
$consulta2 = $mysqli->query($sql2);
}
?>
<html>
<head>
<meta http-equiv="Refresh" content="1;url=index.php">
<title>Citas para Asesoría</title>
</head>