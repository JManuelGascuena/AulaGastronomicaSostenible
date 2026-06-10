<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir: Aula Gastronómica Sostenible</title>
    <!-- Bootstrap CSS -->
    <link href="./../css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Externo -->
    <link rel="stylesheet" href="./../css/all.min.css"> <!--fuente fontawesome versión 7.2.0 -->
    <link rel="stylesheet" href="./../css/estilos.css">
    <!--JavaScript-->
    <script src="./../js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./../js/script_hamburguesa.js" defer></script>
</head>

<body class="bodyFormulario">
    
    <?php 
         include './../encabezado-administracion.php'; // Carga la parte de arriba comunes en las páginas
    ?>

    <br>

    <main class="login-main">
    <!-- Aumentamos el ancho para que quepan etiqueta + control cómodamente -->
    <div class="contenedor-login" style="width: 600px;"> 
        <h2 class="h2Formulario">Añadir Showcooking</h2>
        
        <!-- BLOQUE PARA MENSAJES -->
<!-- Mensaje de ÉXITO -->
<?php if (isset($_GET['msg']) && $_GET['msg'] == 'ok'): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;">
        ¡Showcooking guardado con éxito!
    </div>
<?php endif; ?>

<!-- Mensaje de ERROR (Añade este bloque) -->
<?php if (isset($_GET['msg']) && $_GET['msg'] == 'error' && isset($_GET['error'])): ?>
    <div class="mensaje-error">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>


        <form method="POST" action="./api/guardar_showcooking.php">

            <div class="fila-form">
                <label class="labelFormulario">Título</label>
                <input type="text" name="titulo" class="inputFormulario" required>
            </div>
            
            <div class="fila-form">
                <label class="labelFormulario">Descripción</label>
                <textarea name="descripcion" class="inputFormulario" rows="2" style="resize: none;"></textarea>
            </div>
            
            <div class="fila-form">
                <label class="labelFormulario">Huella YouTube</label>
                <input type="text" 
                   name="huellaYoutube" 
                   id="huellaYoutube"
                   class="inputFormulario" 
                   required 
                   minlength="11" 
                   maxlength="11" 
                   placeholder="Ej: DTC9xWtJ2Nk"
                   title="La huella de YouTube debe tener exactamente 11 caracteres">
            </div>
            
            <div class="fila-form">
                <label class="labelFormulario">Fecha creación</label>
                <input type="datetime-local" name="fechaCreacion" class="inputFormulario" 
                value="<?php echo date('Y-m-d\TH:i'); ?>"
                step="60"
                required>
            </div>

            <div class="fila-form">
                <label class="labelFormulario">¿Publicado?</label>
                <input type="checkbox" name="publicado" id="publicado" style="width: 20px; height: 20px;">
            </div>
            
            <!-- Botones -->
            <div style="display: flex; gap: 15px; margin-top: 25px;">
                <a href="./InicioAdministracion.php" class="buttonFormulario buttonSecundarioFormulario" style="">Volver</a>
                <button type="submit" class="buttonFormulario">Guardar</button>
            </div>
        </form>
    </div>
    </main>

    <?php include './../pieDePagina-administracion.php'; ?>    

</body>
</html>