<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Citas para Asesoría</title>
<style type="text/css">
body {
	background-color: #FFC;
}
#form1 p {
	text-align: center;
}
</style>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p>REGISTRO DE NOTAS</p>
  <p>Código: 
    <label for="cod"></label>
    <input type="text" name="cod" id="cod" />
  </p>
  <p>Materia: 
    <label for="mat"></label>
    <label for="mat"></label>
    <select name="mat" id="mat" onchange="MM_jumpMenu('parent',this,0)">
      <option>Fisica</option>
      <option>Matematicas</option>
      <option>Lenguaje</option>
      <option>Ingles</option>
      <option>Biología</option>
    </select>
  </p>
  <p>Nota: 
    <label for="not"></label>
    <input type="text" name="not" id="not" />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Registrar " />
  </p>
</form>
</body>
</html>