<?php
$PDO = require('./../configuracao/backend.php');

try {
    $sql =
        "INSERT INTO
            post (titulo, descricao, data, codsubtema, conteudo, coduser)
        VALUES (
            :titulo,
            :descricao,
            :data,
            :codsubtema,
            :conteudo,
            :coduser
        )";

    $prepared = $PDO->prepare($sql);

    if (!$prepared->execute([
        'titulo' => $_POST['titulo'],
        'descricao' => $_POST['descricao'],
        'data' => $_POST['data'],
        'codsubtema' => $_POST['subtema'],
        'conteudo' => $_POST['conteudo'],
        'coduser' => $_SESSION['id']
    ])) {
        $_SESSION['erro'] = 'Erro ao criar post!';
    } else {
        header('Location: ' . BASE_PATH . '/index.php');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['erro'] = $e->getMessage();
}

header('Location: ' . BASE_PATH . '/views/criarpost.php');
