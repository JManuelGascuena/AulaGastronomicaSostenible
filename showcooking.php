<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showcooking: Aula Gastronómica Sostenible</title>
    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Externo -->
    <link rel="stylesheet" href="./css/all.min.css"> <!--fuente fontawesome versión 7.2.0 -->
    <link rel="stylesheet" href="./css/estilos.css">
    <!--JavaScript-->
    <script src="./js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./js/script_hamburguesa.js" defer></script>
    <script src="./js/script_showcooking.js" defer></script>
</head>

<?php
// 1. Cargar solo las variables
require_once './configuracion.php';

try {
    // 2. Crear la conexión usando las variables de configuracion.php
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Obtener los datos
    $sql = "SELECT huellaYoutube, titulo FROM Showcooking WHERE publicado = TRUE ORDER BY fechaCreacion DESC";
    $stmt = $pdo->query($sql);
    
    // 4. Mapear a la estructura deseada
    $videos = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $videos[] = [
            'id'   => $row['huellaYoutube'],
            'desc' => $row['titulo']
        ];
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<body class="bodyShowcooking">

<?php
        include './encabezado.php'; // Carga la parte de arriba comunes en las páginas
?>

<br>

<div class="container py-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">    
        <?php
        foreach ($videos as $video): ?>
            <div class="col">
                <div class="card h-100 shadow-sm custom-card">
                    <div class="ratio-16x9">
                        <div class="error-placeholder">
                            <svg xmlns="http://w3.org" width="32" height="32" fill="currentColor" class="bi bi-exclamation-triangle mb-2" viewBox="0 0 16 16">
                              <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z""")/>>
                              <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z""")/>>
                            </svg>
                            <small>El video no pudo cargarse.<br>Pruebe el botón de abajo.</small>
                        </div>
                        <iframe src="https://www.youtube.com/embed/<?php echo $video['id']; ?>" title="YouTube video" allowfullscreen></iframe>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <p class="card-text text-dark"><?php echo $video['desc']; ?></p>
                        <!-- Botón que activa el Modal -->
                        <button type="button" 
                                class="btn btn-secondary mt-auto" 
                                data-bs-toggle="modal" 
                                data-bs-target="#videoModal" 
                                data-bs-id="<?php echo $video['id']; ?>"
                                data-bs-title="<?php echo $video['desc']; ?>">
                           Ver video en ventana modal
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<!-- Estructura del Modal (Único para todos los videos) -->
<!-- Cambiar modal-lg por modal-xl para que sea extra grande -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> 
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="videoModalLabel">Video</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <!-- La clase ratio-16x9 mantendrá la proporción perfecta -->
                <div class="ratio ratio-16x9">
                    <iframe src="" id="videoFrame" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
        include './pieDePagina.php'; // Carga el pie de página al final
?>

</body>
</html>