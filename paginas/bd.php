<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = ''; 
$basedatos = 'academia';

$conexion = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}
?>