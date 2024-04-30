<?php
$PDO = require('./../configuracao/backend.php');

try {
    $sql =
        "DELETE FROM post WHERE codpost = :id";

    $prepared = $PDO->prepare($sql);

    if (!$prepared->execute(['id' => $_POST['id']])) {
        $_SESSION['erro'] = 'Erro ao excluir post!';
    } else {
        header('Location: ' . BASE_PATH . '/index.php');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['erro'] = $e->getMessage();
}

header('Location: ' . BASE_PATH . '/views/posts.php?id=' . $_POST['id']);
