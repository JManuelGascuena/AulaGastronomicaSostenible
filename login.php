<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login: Aula Gastronómica Sostenible</title>
    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Externo -->
    <link rel="stylesheet" href="./css/all.min.css"> <!--fuente fontawesome versión 7.2.0 -->
    <link rel="stylesheet" href="./css/estilos.css">
    <!--JavaScript-->
    <script src="./js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<?php
// 1. Cargamos la configuración y conectamos
require_once './configuracion.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userForm = $_POST['usuario'] ?? '';
    $passForm = $_POST['clave'] ?? '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. Buscamos al usuario por su nombre
        $sql = "SELECT nombre, clave FROM Usuario WHERE nombre = :nombre";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nombre' => $userForm]);
        $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

        // 3. Verificamos si existe y si la clave coincide
        // Nota: Si en el futuro usas password_hash, aquí usarías password_verify
        if ($usuarioEncontrado && $usuarioEncontrado['clave'] === $passForm) {
            //"crea" la sesión en el servidor y guarda la marca de que el usuario ha entrado:
            session_start();
            $_SESSION['usuario'] = $usuarioEncontrado['nombre'];
            header("Location: ./Administracion/InicioAdministracion.php");
            exit();
        } else {
            $error = "Usuario y/o contraseña incorrectos";
        }
    } catch (PDOException $e) {
        $error = "Error de conexión con la base de datos";
    }
}
?>

<body class="bodyFormulario">
    <!-- El encabezado se queda arriba 
         Carga la parte de arriba comunes en las páginas -->
    <?php include './encabezado.php'; ?>

    <br>

    <!-- Contenedor principal para centrar solo el formulario -->
    <main class="login-main">
        <div class="contenedor-login">
            <h2 class="h2Formulario">Administración</h2>
            
            <?php if ($error): ?> 
                <div class="mensaje-error"><?= $error ?></div> 
            <?php endif; ?>

            <form method="POST">
                <label class="labelFormulario">Usuario</label>
                <input type="text" name="usuario" class="inputFormulario" required>
                
                <label class="labelFormulario">Contraseña</label>
                <input type="password" name="clave" class="inputFormulario" required>
                
                <button type="submit" class="buttonFormulario">Iniciar Sesión</button>
            </form>
        </div>
    </main>

    <?php
        include './pieDePagina.php'; // Carga el pie de página al final
?>    

</body>

</html>