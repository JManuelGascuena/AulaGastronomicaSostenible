<?php
session_start();

// 1. Seguridad: Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ./../../login.php");
    exit();
}

require_once './../../configuracion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 2. Recoger datos del formulario
    $idOriginal   = $_POST['id_original'] ?? ''; // La huella antes de ser editada
    $titulo       = $_POST['titulo'] ?? '';
    $descripcion  = $_POST['descripcion'] ?? '';
    $huellaNueva  = $_POST['huellaYoutube'] ?? '';
    $fecha        = $_POST['fechaCreacion'] ?? '';
    $publicado    = isset($_POST['publicado']) ? 1 : 0;

    // 3. Validación básica
    if (strlen($huellaNueva) !== 11) {
        header("Location: ./editar_video.php?id=$idOriginal&msg=error&error=" . urlencode("La huella debe tener 11 caracteres."));
        exit();
    }

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 4. Sentencia SQL de actualización
        $sql = "UPDATE Showcooking 
                SET titulo = :titulo, 
                    descripcion = :descripcion, 
                    huellaYoutube = :huellaNueva, 
                    fechaCreacion = :fecha, 
                    publicado = :publicado 
                WHERE huellaYoutube = :idOriginal";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':titulo'       => $titulo,
            ':descripcion'  => $descripcion,
            ':huellaNueva'  => $huellaNueva,
            ':fecha'        => $fecha,
            ':publicado'    => $publicado,
            ':idOriginal'   => $idOriginal
        ]);

        // 5. Redirigir al panel de administración con mensaje de éxito
        header("Location: ./../InicioAdministracion.php?msg=edit_ok");
        exit();

    } catch (PDOException $e) {
        // Manejo de errores (ej: si la nueva huella ya existe en otro video)
        $msg = urlencode("Error al actualizar: " . $e->getMessage());
        header("Location: ./editar_showcooking.php?id=$idOriginal&msg=error&error=$msg");
        exit();
    }
}
