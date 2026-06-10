<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./../login.php");
    exit();
}

require_once './../configuracion.php';

// 1. Obtener el ID del video a editar
$idVideo = $_GET['id'] ?? '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Consultar los datos actuales del video
    $stmt = $pdo->prepare("SELECT * FROM Showcooking WHERE huellaYoutube = :id");
    $stmt->execute(['id' => $idVideo]);
    $video = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$video) {
        die("Video no encontrado.");
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Showcooking</title>
    <link href="./../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../css/estilos.css">
    <script src="./../js/script_hamburguesa.js" defer></script>
</head>

<body class="bodyFormulario">
    <?php 
    include './../encabezado-administracion.php'; // Carga la parte de arriba comunes en las páginas
    ?>
    
    <br>

    <main class="login-main">
        <div class="contenedor-login" style="width: 600px;"> 
            <h2 class="h2Formulario">Editar Showcooking</h2>
            
            <!-- El action apunta a un archivo que procesará el UPDATE -->
            <form method="POST" action="./api/actualizar_showcooking.php">
                <!-- Campo oculto para saber qué registro estamos editando -->
                <input type="hidden" name="id_original" value="<?= $video['huellaYoutube'] ?>">

                <div class="fila-form">
                    <label class="labelFormulario">Título</label>
                    <input type="text" name="titulo" class="inputFormulario" value="<?= htmlspecialchars($video['titulo']) ?>" required>
                </div>
                
                <div class="fila-form">
                    <label class="labelFormulario">Descripción</label>
                    <textarea name="descripcion" class="inputFormulario" rows="2"><?= htmlspecialchars($video['descripcion']) ?></textarea>
                </div>
                
                <div class="fila-form">
                    <label class="labelFormulario">Huella YouTube</label>
                    <input type="text" name="huellaYoutube" class="inputFormulario" value="<?= $video['huellaYoutube'] ?>" required minlength="11" maxlength="11">
                </div>
                
                <div class="fila-form">
                    <label class="labelFormulario">Fecha creación</label>
                    <!-- Formateamos la fecha para que el input datetime-local la entienda -->
                    <input type="datetime-local" name="fechaCreacion" class="inputFormulario" value="<?= date('Y-m-d\TH:i', strtotime($video['fechaCreacion'])) ?>" required>
                </div>

                <div class="fila-form">
                    <label class="labelFormulario">¿Publicado?</label>
                    <input type="checkbox" name="publicado" style="width: 20px; height: 20px;" <?= $video['publicado'] ? 'checked' : '' ?>>
                </div>
                
                <div style="display: flex; gap: 15px; margin-top: 25px;">
                    <a href="./InicioAdministracion.php" class="buttonFormulario" style="text-decoration:none; text-align:center; background-color:#6c757d !important;">Cancelar</a>
                    <button type="submit" class="buttonFormulario">Actualizar Cambios</button>
                </div>
            </form>
        </div>
    </main>

    <?php include './../pieDePagina-administracion.php'; ?>    
</body>
</html>