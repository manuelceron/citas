<?php
function conectaDB()
{
//Conexión con el servirdor y la BD

//$mysqli = new mysqli('SERVIDOR','USUARIO','CONTRASEÑA_USUARIO','NOMBRE_BD');
//require_once ("mysqli2.php");
$mysqli = new mysqli('localhost','root','12345678','citas');

//Valida la conexión si fue erronea
if(mysqli_connect_errno()){
	echo 'Conexion Fallida : ', mysqli_connect_error();
	exit();
}
else 
{
	if($mysqli){ // Todos los registros que salgan y entren de la BD los convierte a UTF-8 (Ñ,á,é,í,ó,ú,ü)
		mysqli_set_charset($mysqli,'utf8');
    }
}
return $mysqli;
}
?>