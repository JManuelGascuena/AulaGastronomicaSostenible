<?php
session_start(); // Necesario para acceder a la sesión actual
session_unset(); // Libera todas las variables de sesión (como 'usuario')
session_destroy(); // Destruye la sesión físicamente

// Rediriges al login o al index
header("Location: ./../index.php"); 
exit();
?>


