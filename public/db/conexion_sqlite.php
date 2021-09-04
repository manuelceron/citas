<?php
// FUNCIÓN DE CONEXIÓN CON LA BASE DE DATOS SQLITE
function conectaDb()
{
    try {
        $db = new PDO("sqlite:db/cita.db");
        return($db);
    } catch (PDOException $e) {
        print "<p>Error: No puede conectarse con la base de datos.</p>\n";
//      print "<p>Error: " . $e->getMessage() . "</p>\n";
        exit();
    }
}

// EJEMPLO DE USO DE LA FUNCIÓN ANTERIOR
// La conexión se debe realizar en cada página que acceda a la base de datos
?>
 