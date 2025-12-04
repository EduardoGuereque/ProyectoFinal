<?php
session_start();
require_once 'src/config/db.php';
require_once 'src/Models/Usuario.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: admin.php');
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarioModel = new Usuario($conn);
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuarioLogueado = $usuarioModel->login($email, $password);

    if ($usuarioLogueado) {
        $_SESSION['admin_id'] = $usuarioLogueado['id'];
        $_SESSION['admin_email'] = $usuarioLogueado['email'];
        
        header('Location: admin.php');
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Kigüi Music</title>
    <link rel="stylesheet" href="src/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include 'components/header.php'; ?>

    <main class="container">
        <div class="admin-contenedor" style="max-width: 400px; margin-top: 80px;">
            <h1>Acceso Admin</h1>
            
            <?php if ($error): ?>
                <div class="alerta error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="formulario-admin">
                <div class="campo">
                    <label>Correo Electrónico:</label>
                    <input type="email" name="email" required placeholder="admin@kigui.com">
                </div>
                <div class="campo">
                    <label>Contraseña:</label>
                    <input type="password" name="password" required placeholder="****">
                </div>
                
                <button type="submit" class="boton-guardar">Entrar</button>
            </form>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>