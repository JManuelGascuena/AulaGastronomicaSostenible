<?php
session_start();
if (!isset($_SESSION['usuario'])) exit("No autorizado");

require_once './../../configuracion.php';

if (isset($_POST['id']) && isset($_POST['publicado'])) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
        $sql = "UPDATE Showcooking SET publicado = :pub WHERE huellaYoutube = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':pub' => $_POST['publicado'],
            ':id'  => $_POST['id']
        ]);
        echo "ok";
    } catch (PDOException $e) {
        echo "error";
    }
}
?>