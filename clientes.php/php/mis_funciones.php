<?php

function conectarBD() {
    $host = "localhost";
    $usuario = "root";
    $clave = "";
    $bd = "empresa_db";

    $conexion = new mysqli($host, $usuario, $clave, $bd);

    if ($conexion->connect_error) {
        die("<div class='error-message'>❌ Error de conexión: " . $conexion->connect_error . "</div>");
    }

    $conexion->set_charset("utf8");
    return $conexion;
}






















?>