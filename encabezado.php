<?php
// Obtenemos el nombre del archivo actual (ej: index.php)
$pagina_actual = basename($_SERVER['PHP_SELF']);
?>

<div class="contenedor-fijo">
    
    <header class="cabecera-principal">
        <a href="https://www.cifpcuenca.es/"> <img src="./img/cifpcuencanro1.png" alt="Logo CIFP Cuenca" class="logo"></a>
        <h1 class="titulo-proyecto">Aula Gastronómica Sostenible</h1>           
        <img src="./img/logoProyecto.jpg" alt="Logo Proyecto" class="logop">
    </header>

    <nav class="bg-primary">
        <!-- Botón para abrir/cerrar menú en móviles -->
        <button class="nav-toggle" aria-label="Abrir menú">
            <i class="fa-solid fa-bars"></i>
        </button>
        <ul class="nav-lista">
            <li><a href="./index.php" class="nav-link <?php echo ($pagina_actual == 'index.php') ? 'active' : ''; ?>">INICIO</a></li>
            <li><a href="./showcooking.php" class="nav-link <?php echo ($pagina_actual == 'showcooking.php') ? 'active' : ''; ?>">SHOWCOOKING</a></li>
            <li><a href="./login.php" class="nav-link <?php echo ($pagina_actual == 'login.php') ? 'active' : ''; ?>"><i class="fa-solid fa-user"></i> LOGIN</a></li>
        </ul>
    </nav>

</div>