<?php
function btn($action,$cod,$nombre="Enviar",$source="")
{
if ($source<>""){
$origen = 'img/'.$source;
?>
<script> 
window.addEventListener("DOMContentLoaded", function () {
var form = document.getElementById("<?php echo 'form'.$nombre; ?>");
document.getElementById("submit<?php echo $nombre; ?>").addEventListener("click", function () {
  form.submit();
alert('d');
});
});

</script>
<?php
$retorno= '<form id="form'.$nombre.'" name="form'.$nombre.'" method="post" action="'.$action.'">
  <input name="cod" type="hidden" id="cod" value="'.$cod.'">
  <input type="button" name="submit'.$nombre.'" id="submit'.$nombre.'" style ="background-image:url('.$origen.');background-repeat:no-repeat;
  height:40px; width:40px; background-position:center; background-color:#222d99; border: 0px" onClick="enviar_formulario(form'.$nombre.');">';
return $retorno;
//  <a href="#" onClick="enviar_formulario(form'.$nombre.');"><img src="img/nuevo.png"></a></form>';
}else
{
return '<form id="form'.$nombre.'" name="form'.$nombre.'" method="post" action="'.$action.'">
  <input name="cod" type="hidden" id="cod" value="'.$cod.'">
  <input type="submit" name="submit" id="submit" value="'.$nombre.'">
</form>';	
}
}
function nuevaentidad()
{
return '<form id="formentidad" name="formentidad" method="post" action="'.$action.'">
  <input name="cod" type="hidden" id="cod" value="'.$cod.'">
  <input type="submit" name="submit" id="submit" value="'.$nombre.'">
</form>';	
}
function departamento($id){
require('conexion.php'); 
$sql = 'SELECT `departamento` FROM `departamento` WHERE `id_departamento` = '.$id.';';
$consulta = $mysqli->query($sql);
if($row=$consulta->fetch_assoc())
{
return $row['departamento'];
}
else
{
return false;
}
}
function departamentos(){
	require('conexion.php'); 
	$sql = 'SELECT `id_departamento`, `departamento` FROM `departamento`;';
	$consulta = $mysqli->query($sql);
	$departamentos=array();
		while($row=$consulta->fetch_assoc())
		{	
		$id = $row['id_departamento'];
		$departamento = $row['departamento'];
		$departamentos[$id] = $departamento;
		}
	return $departamentos;
}
function ciudad($id){
require('conexion.php'); 
$sql = 'SELECT `ciudad`, `id_departamento` FROM `ciudad` WHERE `id_ciudad` = '.$id.';';
$consulta = $mysqli->query($sql);
if($row=$consulta->fetch_assoc())
{	
return $row['ciudad']." - ".departamento($row['id_departamento']);
}
else
{
return false;
}
}
function ciudades(){
	require('conexion.php'); 
	$sql = 'SELECT `id_ciudad`, `ciudad`, `id_departamento` FROM `ciudad`';
	$consulta = $mysqli->query($sql);
	$ciudades=array();
		while($row=$consulta->fetch_assoc())
		{	
		$id = $row['id_ciudad'];
		$departamento = departamento($row['id_departamento']);
		$ciudad = $row['ciudad']." - ".$departamento;
		$ciudades[$id] = $ciudad;
		}
	return $ciudades;
}
function select($c,$nom,$pre=1){
	if (isset($c)) {
	if ($pre==1) $pre=$c[1];
	echo '<select class="combo" name="'.$nom.'" id="'.$nom.'"  value="">';
		for ($i=1;$i<=(count($c));$i++){
		$option = '<option ';
		if ($c[$i]==$pre) $option .= 'selected';
		$option .= ' value='.$i.'>'.$c[$i].'</option>';
		echo $option;
		}
	echo '</select>';
	}
}//fin function select
function menu()
{
return '<p>
<a class="imenu" href="index.php">Inicio</a> - 
<a class="imenu" href="usuario.php">Usuario</a>
</p>';
}
?>
