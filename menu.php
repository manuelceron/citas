<?php
	  //session_start();
	  ?>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/estilo_menu.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/script_menu.js"></script>
   <title>Citas para Asesoría</title>

<div id='cssmenu'>
<ul>
   <li><a href="index.php">Inicio</a></li>
   <li><a href="listareserva.php">Reservar</a></li>
   <li><a href="consultar.php">Consultar</a></li>
      <?php
	  session_start();
   if (isset($_SESSION['asesores_usu'])){
	 ?>
   <li><a href="estudiante.php">Estudiantes</a></li>
   <li><a href="asesor.php">Asesores</a></li>
   <li><a href="franja.php">Franjas</a></li>
   <li><a href="franja-asesor.php">Asignar Franjas</a></li>
   <li><a href="registros.php">Ver todas los citas</a></li>
    <li><a href="sesion.php?logout">Cerrar Sesi&oacute;n<br><?php echo $_SESSION['asesores_usu'];?></a></li>
   <?php
   }else{
	   ?>
   <li><a href="sesion.php">Iniciar Sesi&oacute;n</a></li>
   <?php 
   }
   ?>
   
</ul>
</div>
