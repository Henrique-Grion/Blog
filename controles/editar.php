<?php
$PDO = require('./../configuracao/backend.php');

try {
    $sql =
        "UPDATE 
            post
        SET
            titulo = :titulo,
            descricao = :descricao,
            conteudo = :conteudo,
            data = :data,
            dataalter = NOW(),
            codsubtema = :codsubtema
        WHERE
            codpost = :id";

    $prepared = $PDO->prepare($sql);

    if (!$prepared->execute([
        'titulo' => $_POST['titulo'],
        'descricao' => $_POST['descricao'],
        'conteudo' => $_POST['conteudo'],
        'data' => $_POST['data'],
        'codsubtema' => $_POST['codsubtema'],
        'id' => $_POST['id']
    ])) {
        $_SESSION['erro'] = 'Erro ao editar post!';
    } else {
        header('Location: ' . BASE_PATH . '/views/posts.php?id=' . $_POST['id']);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['erro'] = $e->getMessage();
}

header('Location: ' . BASE_PATH . '/views/editar.php?id=' . $_POST['id']);
