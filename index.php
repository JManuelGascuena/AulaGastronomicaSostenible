<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula Gastronómica Sostenible</title>
    <link rel="stylesheet" href="./css/all.min.css"> <!--fuente fontawesome versión 7.2.0 -->
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/estilos-infografia.css">
    <script src="./js/script_hamburguesa.js" defer></script>
</head>

<body>

<?php
        include './encabezado.php'; // Carga la parte de arriba comunes en las páginas
?>
<br>

<div class="infografia-contenido-sub">

    <i><p class="infografia-li">"Aula Gastronómica Sostenible" nace en la familia profesional de Hostelería y Turismo como una 
    propuesta de innovación vinculada a la sostenibilidad, las metodologías activas y la creación 
    de recursos útiles para el aula. El proyecto crece con la colaboración de Imagen y Sonido e 
    Informática, incorporando edición audiovisual, publicación web y trabajo digital compartido. 
    Su vocación es seguir ampliándose y abrir nuevas vías de participación para otras familias 
    profesionales del centro.  
    </p></i>
</div>

<br>

<div class="infografia-tarjeta-principal infografia-div-tarjeta-principal">
    <div class="infografia-cabecera-principal">
        Aula Gastronómica Sostenible: Metodologías Activas y Recursos Digitales en FP
    </div>

    <div class="infografia-grid-container">
        
        <!-- Fila 1: Objetivos (Se igualan automáticamente en desktop) -->
        <div class="infografia-subtarjeta">
            <div class="infografia-cabecera-sub">Objetivo General</div>
            <div class="infografia-contenido-sub">
            <ul class="infografia-ul">
            <li class="infografia-li"><i>
                Mejorar el aprendizaje competencial en FP de Hostelería integrando cocina sostenible y recursos digitales, mediante metodologías activas y trabajo inter-familias.
            </i></li>
            </div>
        </div>

        <div class="infografia-subtarjeta">
            <div class="infografia-cabecera-sub">Objetivos Específicos</div>
            <div class="infografia-contenido-sub">
                <ul class="infografia-ul">
                    <li class="infografia-li"><i>Diseñar y aplicar secuencias intermodulares.</i></li>
                    <li class="infografia-li"><i>Crear materiales transferibles con apoyo de Informática y 3D/Vídeo.</i></li>
                    <li class="infografia-li"><i>Reforzar la competencia digital de profesorado y alumnado.</i></li>
                    <li class="infografia-li"><i>Reducir mermas y desperdicio con criterios de economía circular.</i></li>
                </ul>
            </div>
        </div>

        <!-- Fila 2: Participantes y Resultados -->
        <div class="infografia-subtarjeta">
            <div class="infografia-cabecera-sub">Centros educativos participantes</div>
            <div class="infografia-contenido-sub">
                <ul class="infografia-lista-centros infografia-ul">
                    <li class="infografia-li"><b>Coordinador y Responsable:</b>
                        <ul class="infografia-ul">
                            <li class="infografia-li"><i><a href="https://www.cifpcuenca.es/" target="_blank">Centro Integrado de FP Nº1 de Cuenca </a>. José Javier Moreno Escudero</i></li>
                        </ul>
                    </li>
                    <li class="infografia-li"><b>Colaboradores y Responsables:</b>
                        <ul class="infografia-ul">
                            <li class="infografia-li"><i><a href="https://iesalarcos.com/" target="_blank">IES Santa María de Alarcos </a> (Ciudad Real). Patricia Laguna Pérez</i></li>
                            <li class="infografia-li"><i><a href="https://iesfrayluis.com/" target="_blank">IES Fray Luis de León </a> (Cuenca). Jose Francisco Atienza Matas</i></li>
                            <li class="infografia-li"><i><a href="https://universidadlaboralab.es/" target="_blank">IES Universidad Laboral </a>(Albacete). Javier Collado Rodríguez</i></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="infografia-subtarjeta">
            <div class="infografia-cabecera-sub">Resultados esperados</div>
            <div class="infografia-contenido-sub">
                <ul class="infografia-ul">
                    <li class="infografia-li"><i><b>Comunidad:</b> Motivación y repositorio replicable.</i></li>
                    <li class="infografia-li"><i><b>Igualdad:</b> Visibilidad de referentes femeninos y roles equilibrados.</i></li>
                    <li class="infografia-li"><i><b>Sector:</b> Mejora de empleabilidad y estándares reales de calidad.</i></li>
                </ul>
            </div>
        </div>

        <!-- Fila 3: Sitio Web (Ancho completo) -->
        <div class="infografia-subtarjeta infografia-full-width">
            <div class="infografia-cabecera-sub">Sitio Web</div>
            <div class="infografia-contenido-sub">
                <ul class="infografia-ul">
                    <li class="infografia-li"><i>Este sitio web es un repositorio transferible fruto de la colaboración inter-familias 
                        (Departamento de Informática y Departamento de Imagen y Sonido del CIFP Nº1 de Cuenca), 
                        en el que se encuentran los materiales audiovisuales e interactivos reutilizables 
                        generados en los centros educativos participantes como resultado del proyecto 
                        "Aula Gastronómica Sostenible".</i></li>
                </ul>
            </div>
        </div>

    </div>
</div>


<?php

        // 1. Cargar solo las variables
        require_once './configuracion.php';

        $conexion = mysqli_connect($host, $user, $password, $db);

        // 2. Consulta para obtener el Showcooking más reciente publicado
        $query = "SELECT huellaYoutube FROM Showcooking WHERE publicado = 1 ORDER BY fechaCreacion DESC LIMIT 1";
        $resultado = mysqli_query($conexion, $query);
        $video = mysqli_fetch_assoc($resultado);

        // 3. Mostrar el video si existe
        if ($video) {
            $huella = $video['huellaYoutube'];
            /**
             * PARAMETROS EXPLICADOS:
             * autoplay=1  -> Intenta reproducir solo.
             * mute=1      -> necesario para autoplay en navegadores modernos
             * loop=1      -> Activa el bucle.
             * playlist=ID -> YouTube requiere el ID del video aquí para que el loop funcione. Sin este parámetro se detendrá el video al terminar la primera vez
             * rel=0       -> No muestra videos relacionados al final.
             * &enablejsapi=1  "abre la puerta" para que el script controle el video. NO FUNCIONA EL CODIGO QUIZAS SE PUEDA QUITAR
            */
            $urlEmbed = "https://youtube.com/embed/$huella?autoplay=1&mute=1&loop=1&playlist=$huella&rel=0&enablejsapi=1";
?>
            <br>

            <div class="infografia-video-container-wrapper">
                <div class="infografia-video-responsive">
                  <iframe 
                    id="miVideoYoutube"
                    src="<?php echo $urlEmbed; ?>" 
                    allow="autoplay; encrypted-media" 
                    allowfullscreen>
                  </iframe>
                </div>
            </div>
<?php
           }
           mysqli_close($conexion);
?>


<?php
        include './pieDePagina.php'; // Carga el pie de página al final
?>

<script>
    window.onload = function() {
        // --- LÓGICA PARA EL SCROLL PARA VER EL VIDEO ---
        const videoSection = document.querySelector('.infografia-video-container-wrapper');
        const headerFijo = document.querySelector('.contenedor-fijo');
        
        if (videoSection && headerFijo) {
            // Calculamos la altura del menú para restarla de la posición final
            const offset = headerFijo.offsetHeight;
            const bodyRect = document.body.getBoundingClientRect().top;
            const elementRect = videoSection.getBoundingClientRect().top;
            const elementPosition = elementRect - bodyRect;
            const offsetPosition = elementPosition - offset;

            window.scrollTo({
                top: offsetPosition+150,
                behavior: 'smooth'
            });
        }

        // --- LÓGICA PARA EL SONIDO ---
        // NO FUNCIONA
        // 1. Definir el evento personalizado
        const miClicEvento = new CustomEvent('miclic', {
            detail: { mensaje: 'Ejecutando clic automático' }
        });

        // 2. Programar qué hace el evento cuando ocurra
        window.addEventListener('miclic', function() {
            const iframe = document.getElementById('miVideoYoutube');
            if (iframe) {
                // Intentar "hacer clic" mediante la API de YouTube
                iframe.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
                iframe.contentWindow.postMessage('{"event":"command","func":"unMute","args":""}', '*');
                console.log("Evento 'miclic' ejecutado: comando de reproducción enviado.");
           }
        });

        // 3. Lanzar el evento automáticamente al cargar la página
        window.dispatchEvent(miClicEvento);
        
    };
</script>

</body>
</html>