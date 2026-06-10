<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-info">
            <p class="footer-title">Centro Integrado de Formación Profesional Nº1 de Cuenca</p>
            <p class="footer-author">Sitio Web Desarrollado por Departamento de Informática</p>
            <p class="footer-copy">&copy; 2026 - Todos los derechos reservados</p>
        </div>

        <div class="logo-grid">
            <?php
            $logos = [
                'UnionEuropea2.png', 'FondoSocialEuropeo.jpg', 'MinisterioDeEducacónFormacionProfesionalYDeportes.jpg', 
                'GobiernoDeCastillaLaMancha.jpg', 'RecuperacionTransformacionResilencia.png', 'cifpcuencanro1.png'
            ];
            
            $urls = [
                1 => "https://european-union.europa.eu/index_es",
                2 => "https://wayback.archive-it.org/12090/20220818103640/https://ec.europa.eu/esf/home.jsp?langId=es",
                3 => "https://www.educacionfpydeportes.gob.es/portada.html",
                4 => "https://www.castillalamancha.es/",
                5 => "https://planderecuperacion.gob.es/",
                6 => "https://www.cifpcuenca.es/"
            ];

            foreach ($logos as $key => $logo): 
                $i = $key + 1;
                $current_url = $urls[$i] ?? "#";
            ?>
                <div class="logo-item">
                    <a href="<?php echo $current_url; ?>" target="_blank" rel="noopener noreferrer">
                        <img src="./../img/<?php echo $logo; ?>" alt="Logo" class="logo-img">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</footer>
