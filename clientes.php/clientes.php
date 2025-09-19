<?php

    require_once ("php/mis_funciones.php");
    require_once ("php/arreglo.php");

// --- 1. Parámetros de conexión a la base de datos ---
    $db_host = "localhost"; // Servidor, usualmente "localhost" o "127.0.0.1"
    $db_user = "root"; // Usuario de la base de datos (por defecto 'root' en XAMPP)
    $db_pass = ""; // Contraseña (por defecto vacía en XAMPP)
    $db_name = "empresa_db"; // El nombre de tu base de datos


// --- 2. Establecer la conexión usando MySQLi ---
    $conexion = new mysqli($db_host, $db_user, $db_pass, $db_name);

// --- 3. Verificar si la conexión fue exitosa ---
    if ($conexion->connect_error) {

// die() detiene la ejecución del script y muestra un mensaje
    die("<div class='error-message'>❌ Error de conexión: " . $conexion->connect_error . "</div>");
    }

// Para asegurar que los caracteres (acentos, ñ) se muestren correctamente
        $conexion->set_charset("utf8");


// --- 4. Preparar la consulta SQL ---
    $sql = "SELECT Nombre, Apellido, Empresa, Domicilio, Ciudad, Pais, Telefono, Email FROM clientes";
        $resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>

    <link rel="stylesheet" href="css/hoja_estilo_clientes.css">

</head>
<body>
    <div class="container">
        <h1> Listado de Clientes</h1>
<?php


    // --- 5. Generar la tabla HTML dinámicamente ---
    if ($resultado->num_rows > 0) {
        echo "<table>";

    // Cabecera de la tabla
    echo "<thead> <tr> ";

        foreach ($clientes1 as $campo => $valor) {
            echo "<th>" . htmlspecialchars($valor) . "</th>";
        }

    echo "</tr> </thead>";

    // Cuerpo de la tabla

    echo "<tbody>";

    // fetch_assoc() obtiene una fila de resultados como un array asociativo

    while($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
    // Usamos htmlspecialchars() por seguridad para evitar inyección de código HTML/JS
    
        foreach ($clientes1 as $campo => $valor) {
            echo "<td>" . htmlspecialchars($fila[$campo]) . "</td>";
    }
        echo "</tr>";
   
    }

        echo "</tbody>";
        echo "</table>";

    }else {
    echo "<div class='error-message'> No se encontraron registros en la tabla 'clientes'.</div>";
    }

    // --- 6. Cerrar la conexión a la base de datos ---
    $conexion->close();
    $resultado->free();
    
?>

</div>

</body>

</html>