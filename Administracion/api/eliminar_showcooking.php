<?php
session_start();

// 1. Seguridad: Solo usuarios logueados pueden borrar
if (!isset($_SESSION['usuario'])) {
    header("Location: ./../../login.php");
    exit();
}

require_once './../../configuracion.php';

// 2. Obtener el ID (huellaYoutube) del vídeo a eliminar
$idVideo = $_GET['id'] ?? '';

if (!empty($idVideo)) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 3. Sentencia SQL para eliminar el registro
        $sql = "DELETE FROM Showcooking WHERE huellaYoutube = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $idVideo]);

        // 4. Redirigir de vuelta con mensaje de éxito
        header("Location: ./../InicioAdministracion.php?msg=delete_ok");
        exit();

    } catch (PDOException $e) {
        // En caso de error (por ejemplo, restricciones de integridad)
        die("Error al eliminar el video: " . $e->getMessage());
    }
} else {
    // Si no hay ID, volvemos al inicio
    header("Location: ./../InicioAdministracion.php");
    exit();
}