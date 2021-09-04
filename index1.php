<?php session_start();
require ('conex.php');
if(isset($_POST['cod'])){
$datosrecibidos = $_POST['cod'];
$sql = 'select `identificacion`, `nombre`, `apellido` from `cita_estudiante` where `identificacion` ="'.$datosrecibidos.'"';
if ($consulta = $mysqli -> query ($sql)){
$datosestudiante = array();
while ( $row = $consulta -> fetch_assoc()) {
$estudiante = array('identificacion' => $row['identificacion'],'nombre' => $row['nombre'],'apellido' => $row['apellido']);
}
$datosestudiante[] = $estudiante;
echo json_encode($datosestudiante);
}
exit();
}else{
if(isset($_POST['ide'])){
$_SESSION['identificacion'] = $_COOKIE['identificacion'];
$_SESSION['nombre'] = $_COOKIE['nombre'];
$_SESSION['apellido'] = $_COOKIE['apellido'];
echo '<meta http-equiv="refresh" content="0; url=listareserva.php" />';
}
require_once ('function.php');
echo menu();
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Citas para Asesoría</title> 
<link rel="stylesheet" href="estilo.css"> 
</head>

<body>

<script src="js/jquery2.js"></script>
<script>
function getCookie(cname) {
	var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
function grabarcookie(nombre,valor){
document.cookie=nombre+"="+valor;
}
function leercookie(nombre){
var valor = getCookie(nombre);
return valor;
}
function mostrarSugerencia(nombre)
{
$.ajax({
	type:'POST',
	url: 'index.php',
	data:{
	cod: nombre	
		},
	dataType: 'json',
    success: function(estudiante) {                                 
            for(index=0; index<estudiante.length; index++) {
            if (estudiante[index].identificacion.length>0){
		//$('#txtsugerencias').html("Bienvenid@.."+estudiante[index].nombre+' '+estudiante[index].apellido);
		document.getElementById('txtsugerencias').innerHTML = "<a style='text-decoration:none; font-size:22px; color:#000'>Estudiante: "+estudiante[index].nombre+' '+estudiante[index].apellido+"</a>";
		grabarcookie('identificacion',estudiante[index].identificacion);
		grabarcookie('nombre',estudiante[index].nombre);
		grabarcookie('apellido',estudiante[index].apellido);
		//alert(leercookie('identificacion')+" "+leercookie('nombre')+" "+leercookie('apellido'));
		//estudiante[index].identificacion+" "+estudiante[index].nombre+" "+estudiante[index].apellido
				//$("#txtsugerencias").val(mensaje);
			document.getElementById('button').disabled = false;
			document.getElementById('button').hidden = false;
            }//fin if
			}//fin for
      },// fin function estudiante
	  beforeSend: function() {
                        /**
                        * realizar algo mientra se realiza el proceso de envio y recepción
                        */
			if(nombre.length>7){
document.getElementById('txtsugerencias').innerHTML = "<p style='text-decoration:none'>Usuario no registrado :( <BR>Mayor Información en coordinación académica<BR></p>";
			}else{
			document.getElementById('txtsugerencias').innerHTML = "";	
			}//fin if
			document.getElementById('button').disabled = true;
			document.getElementById('button').hidden = true;
       }//fin beforeSend
});// fin ajax
/*.done(function(respuesta){
	$('#txtsugerencias').text(respuesta);
});*/
}//fin function mostrarSugerencia
</script>
<BR /><BR />
<div class="container">

 <section id="content">
<form id="form1" name="form1" method="post" action="index.php">
 <div><label>
   
    <p>Citas para asesoría
      <input type="text" name="ide" id="ide" placeholder="Ingrese su identificacion" maxlength="10" onkeyup ="mostrarSugerencia(this.value)" autocomplete="off" required title="Por favor escriba su documento de identidad"/>
</p></label>
<!--a style='text-decoration:none; font-size:22px; color:#000'>Estudiante:</a-->
</div><style type="text/css">#button{float: initial;}</style>
<div align="center"><input type='submit' name='button' id='button' hidden='true' value='Ingresar' /><span id="txtsugerencias"></span></div>
</form>
</section></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } ?>
</body>
</html>
 