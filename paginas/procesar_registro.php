<?php
session_start();
include("bd.php");
$nombre       = $_POST['nombre']      ?? '';
$email        = $_POST['email']       ?? '';
$password     = $_POST['password']    ?? '';
$dni          = $_POST['DNI']         ?? '';
$telefono     = $_POST['telefono']    ?? '';
$fecha_nac    = $_POST['date']        ?? '';
$condicion    = $_POST['condicion']   ?? '';
if (
    empty($nombre)    ||
    empty($email)     ||
    empty($password)  ||
    empty($dni)       ||
    empty($telefono)  ||
    empty($fecha_nac) ||
    empty($condicion)
) {
    $_SESSION['error_registro'] = "Por favor completá todos los campos.";
    header("Location: registro.php");
    exit();
}

// 3. Verificar email único
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo_electronico = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $_SESSION['error_registro'] = "Este email ya está registrado.";
    header("Location: registro.php");
    exit();
}
$stmt->close();

// 4. Hashear la contraseña
$hash = password_hash($password, PASSWORD_DEFAULT);

// 5. Insertar usuario con rol fijo 'alumno'
$sql = "
    INSERT INTO usuarios
      (nombre, dni, fecha_nacimiento, discapacidad,
       correo_electronico, contrasenia, telefono, rol)
    VALUES
      (?,     ?,   ?,                ?,            
       ?,                   ?,         ?,       'alumno')
";
$stmt = $conexion->prepare($sql);
$stmt->bind_param(
    "sssssss",
    $nombre,
    $dni,
    $fecha_nac,
    $condicion,
    $email,
    $hash,
    $telefono
);

if ($stmt->execute()) {
    // 6. Auto-login tras registro
    $_SESSION['usuarios_id']     = $stmt->insert_id;
    $_SESSION['usuarios_nombre'] = $nombre;
    $_SESSION['usuarios_rol']    = "alumno";

    unset($_SESSION['error_registro']);
    header("Location: ../index.php");
    exit();
} else {
    $_SESSION['error_registro'] = "Error al registrar el usuario.";
    header("Location: registro.php");
    exit();
}
?>