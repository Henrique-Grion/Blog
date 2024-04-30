<?php
$PDO = require('./../configuracao/backend.php');

try {
    $sql =
        "INSERT INTO 
            comentario (coduser, data, texto, codpost)
        VALUES(
            :coduser,
            NOW(),
            :comentario,
            :id
        )";

    $prepared = $PDO->prepare($sql);

    if (!$prepared->execute([
        'coduser' => $_SESSION['id'],
        'comentario' => $_POST['comentario'],
        'id' => $_POST['id']
    ])) {
        $_SESSION['erro'] = 'Erro ao comentar post!';
    }
} catch (Exception $e) {
    $_SESSION['erro'] = $e->getMessage();
}

header('Location: ' . BASE_PATH . '/views/posts.php?id=' . $_POST['id']);
