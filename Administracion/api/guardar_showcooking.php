<?php
session_start();
// 1. Seguridad: Verificar que el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ./../../login.php");
    exit();
}

// 2. Cargar configuración de la BD
require_once './../../configuracion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 3. Recoger y limpiar datos
    $titulo        = $_POST['titulo'] ?? '';
    $descripcion   = $_POST['descripcion'] ?? '';
    $huellaYoutube = $_POST['huellaYoutube'] ?? '';
    $fechaCreacion = $_POST['fechaCreacion'] ?? '';
    // El checkbox solo envía valor si está marcado
    $publicado     = isset($_POST['publicado']) ? 1 : 0;

    // 4. Validación extra en el servidor (Longitud huella)
    if (strlen($huellaYoutube) !== 11) {
        die("Error: La huella de YouTube debe tener exactamente 11 caracteres.");
    }

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 5. Preparar la consulta SQL
        $sql = "INSERT INTO Showcooking (titulo, descripcion, huellaYoutube, fechaCreacion, publicado) 
                VALUES (:titulo, :descripcion, :huellaYoutube, :fechaCreacion, :publicado)";
        
        $stmt = $pdo->prepare($sql);
        
        // 6. Ejecutar el guardado
        $stmt->execute([
            ':titulo'        => $titulo,
            ':descripcion'   => $descripcion,
            ':huellaYoutube' => $huellaYoutube,
            ':fechaCreacion' => $fechaCreacion,
            ':publicado'     => $publicado
        ]);

        // 7. Redirigir al inicio de administración con éxito
        header("Location: ./../aniadirShowcooking.php?msg=ok");
        exit();

    } catch (PDOException $e) {
        // En caso de duplicado (la huella es UNIQUE) o error de conexión
        // Redirige de vuelta con el mensaje de error codificado
        $mensajeError = urlencode("Error al guardar: " . $e->getMessage());
        header("Location: ./../aniadirShowcooking.php?msg=error&error=" . $mensajeError);
        exit();        
        //$mensajeError = "Error al guardar en la base de datos: " . $e->getMessage();
        //header("Location: ./aniadirShowcooking.php?msg=" . urlencode($mensajeError));
        //header("Location: ./aniadirShowcooking.php?msg=ok");
        //exit();


        //die("Error al guardar en la base de datos: " . $e->getMessage());
    }
}
?>