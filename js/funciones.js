// JavaScript Document
function confirmeliminar(page,params,tit) {
		if(confirm("¿Esta ud seguro que quiere eliminar el registro "+tit+"?")) {
			  var body = document.body;
			  form=document.createElement('form'); 
			  form.method = 'POST'; 
			  form.action = page;
			  form.name = 'jsform';
			  for (index in params)
			  {
					var input = document.createElement('input');
					input.type='hidden';
					input.name=index;
					input.id=index;
					input.value=params[index];
					form.appendChild(input);
			  }	  		  			  
			  body.appendChild(form);
			  form.submit();
		}
	}
function nuevoAjax(){
var xmlhttp=false;
try {

htmlhttp=new activeXObject("Msxml2.XMLHTTP");
}
catch (e) {

 try {htmlhttp=new activeXObject("Microsoft.XMLHTTP");
}
catch (e) {

xhtmlhttp=false;
}
}
if (!xmlhttp && typeof XMLHttpRequest!='undefineded'){
xmlhttp=new XMLHttpRequest();
}
return xmlhttp;
}
function buscar(fecha,asesor,horario){
ajax=nuevoAjax();
ajax.open("POST","funciones_reserva.php",true);
ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
		document.getElementById('txtsugerencias').innerHTML = ajax.responseText;
		}
	}
ajax.send("fecha="+fecha+"&asesor="+asesor+"&horario="+horario);
}

function consultarcitas(){
	buscar (document.getElementById('fecha').value,document.getElementById('asesor').value,document.getElementById('grupo').value);
}
function fechahoy(){
	var f=new Date();
	var ano = f.getFullYear();
	var mes = f.getMonth()+1;
	var dia = f.getDate();
	document.getElementById('fecha').value = dia+"-"+mes+"-"+ano;
}
function limpiar(id){
	document.getElementById(id).value="";
}
function btn_formulario(page,params) {
			  var body = document.body;
			  form=document.createElement('form'); 
			  form.method = 'POST'; 
			  form.action = page;
			  form.name = 'jsform';
			  for (index in params)
			  {
					var input = document.createElement('input');
					input.type='hidden';
					input.name=index;
					input.id=index;
					input.value=params[index];
					form.appendChild(input);
			  }	  		  			  
			  body.appendChild(form);
			  form.submit();
}