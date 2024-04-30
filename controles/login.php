<?php
$PDO = require('./../configuracao/backend.php');

try {
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $sql =
            "SELECT 
                senha,
                email,
                coduser,
                nome
            FROM
                usuario
            WHERE
                email = :email";
        $prepared = $PDO->prepare($sql);
        $prepared->execute(['email' => $_POST['email']]);
        $linha = $prepared->fetch();

        if (isset($linha['email']) && isset($linha['senha']) && password_verify($_POST['senha'], $linha['senha'])) {
            $_SESSION['logado'] = true;
            $_SESSION['id'] = $linha['coduser'];
            $_SESSION['nome'] = $linha['nome'];

            header('Location: ' . BASE_PATH . '/index.php');
            exit();
        } else {
            $_SESSION['erro'] = 'E-mail e senha incorretos.';
        }
    } else {
        $_SESSION['erro'] = 'Requisição mal formatada.';
    }
} catch (PDOException $e) {
    $_SESSION['erro'] = $e->getMessage();
}

header('Location: ' . BASE_PATH . '/views/login.php');
