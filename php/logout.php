<?php

// Iniciar a sessão
session_start();

// Limpar todas as variáveis de sessão
session_unset();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login
header('Location: ../index.html'); // Ajuste o caminho para a página de login
exit;

?>
