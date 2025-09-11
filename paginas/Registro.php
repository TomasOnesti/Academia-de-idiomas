<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>academia registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/registro.css">
</head>

<body>
  <div class="container" id="container">
    <h1 class="titulo">Crear cuenta</h1> 
<?php if (!empty($_SESSION['error_registro'])): ?>
  <div class="error"><?= htmlspecialchars($_SESSION['error_registro']) ?></div>
  <?php unset($_SESSION['error_registro']); ?>
<?php endif; ?>
    <div class="form-container sign-up">
      <form action="procesar_registro.php" method="POST" class="grid-form">
        <div><span>Email</span><input type="email" name="email" placeholder="Email" required></div>
        <div><span>Nombre Completo</span><input type="text" name="nombre" placeholder="Nombre" required></div>
        <div><span>Número DNI</span><input type="number" name="DNI" placeholder="DNI" required></div>

        <div><span>Contraseña</span><input type="password" name="password" placeholder="Contraseña" required></div>
        <div><span>Teléfono</span><input type="text" name="telefono" placeholder="Teléfono" required></div>
        <div><span>Fecha de nacimiento</span><input type="date" name="date" required></div>

      <div class="full-width">
  <label for="condicion">¿Sufre alguna condición?</label>
  <select name="condicion" id="condicion" required>
    <option value="">Seleccionar</option>
    <option value="si">Sí</option>
    <option value="no">No</option>
  </select>
</div>

<div class="full-width" id="detalle-condicion" style="display: none;">
  <label for="tipo-condicion">¿Cuál?</label>
  <select name="tipo-condicion" id="tipo-condicion">
    <option value="">Seleccionar tipo</option>
    <option value="mal-vista">Daltonismo</option>
    <option value="sordo">Sordo</option>
    <option value="ciego">Ciego</option>
  </select>
</div>


        <div class="full-width">
  <button type="submit">Registrarse</button>
</div>

<h2 class="login-link">
  ¿Ya tienes una cuenta?
  <a href="login.php">Inicia sesión aquí.</a>
</h2>

      </form>
    </div>
  </div>
</body>
</html>
