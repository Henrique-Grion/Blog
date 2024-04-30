<?php
$PDO = require('./../configuracao/backend.php');

try {
    $sql =
        "INSERT INTO
            usuario (apel, nome, datnas, profissao, email, senha)
        VALUES (
            :apel,
            :nome,
            :datnas,
            :profissao,
            :email,
            :senha
        )";

    $prepared = $PDO->prepare($sql);

    if (!$prepared->execute([
        'apel' => $_POST['apel'],
        'nome' => $_POST['nome'],
        'datnas' => $_POST['datnas'],
        'profissao' => $_POST['profissao'],
        'email' => $_POST['email'],
        'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT),
    ])) {
        $_SESSION['erro'] = 'E-mail já existente.';
    } else {
        $_SESSION['logado'] = true;
        $_SESSION['id'] = $PDO->lastInsertId();
        $_SESSION['nome'] = $_POST['nome'];

        header('Location: ' . BASE_PATH . '/index.php');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['erro'] = $e->getMessage();
}

header('Location: ' . BASE_PATH . '/views/cadastro.php');
