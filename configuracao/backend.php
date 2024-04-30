<?php
define('BASE_PATH', '/projeto2');

$paginas_sem_autenticacao = [
    BASE_PATH . '/controles/login.php',
    BASE_PATH . '/controles/cadastro.php',
    BASE_PATH . '/views/cadastro.php',
    BASE_PATH . '/views/login.php',
    BASE_PATH . '/index.php'
];

session_start();
if (!in_array($_SERVER['REQUEST_URI'], $paginas_sem_autenticacao) && (!isset($_SESSION['logado']) || !$_SESSION['logado'])) {
    $_SESSION['erro'] = 'É necessário estar logado para acessar essa página.';
    header('Location: ' . BASE_PATH . '/index.php');
}

return new PDO('mysql:host=localhost;dbname=blog', 'root', 'Flavio2012');
