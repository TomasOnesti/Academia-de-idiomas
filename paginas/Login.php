<?php session_start();?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia login</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>

<body>
    <div class="container" id="container">

  <h1 class="titulo">Iniciar sesión</h1>
    <?php if (!empty($_SESSION['error_login'])): ?>
        <div class="error-message">
            <?php echo $_SESSION['error_login']; unset($_SESSION['error_login']); ?>
        </div>
    <?php endif; ?>
  <div class="form-container sign-up">   
    <form action="procesar_login.php" method="POST">
      <div class="input-group">
        <span>Gmail</span>
        <input type="email" name="email" placeholder="email@address.com" required>
      </div>
      <div class="input-group">
        <span>Contraseña</span>
        <input type="password" name="password" placeholder="••••••••" required>
      </div>

      <button type="submit">Iniciar sesión</button>


      <h2 class="login-link">
        No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
      </h2>
    </form>
  </div>

</div>

</body>
</html>
