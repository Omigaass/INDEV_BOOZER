<?php
// Iniciar a sessão
session_start();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login ou para a página inicial
header('Location: ../index.html');
exit();
?>
