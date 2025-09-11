<?php
session_start();
include("bd.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
// Validación 
if (empty($email) || empty($password)) {
    $_SESSION['error_login'] = 'Por favor completá todos los campos.';
    header("Location: login.php");
    exit();
}   

// Consultar usuario
$query = "SELECT id, nombre, contrasenia, rol FROM usuarios WHERE correo_electronico = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    $hashGuardado = $usuario['contrasenia'];

    if (password_verify($password, $hashGuardado)) {
        // Guardar sesión
        $_SESSION['usuarios_id'] = $usuario['id'];
        $_SESSION['usuarios_nombre'] = $usuario['nombre'];
        $_SESSION['usuarios_rol'] = $usuario['rol'];

        unset($_SESSION['error_login']);

        // Redirigir a la misma página de inicio para todos
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error_login'] = 'Contraseña incorrecta.';
        header("Location: ../index.php");
        exit();
    }
} else {
    $_SESSION['error_login'] = 'Usuario no encontrado.';
    header("Location: login.php");
    exit();
}
?>